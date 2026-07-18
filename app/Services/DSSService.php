<?php

namespace App\Services;

use App\Models\Assessment;
use Illuminate\Support\Facades\DB;

class DSSService
{
    private function getGapWeight(int $gap): float
    {
        $gapTable = [
            0 => 5.0,  1 => 4.5, -1 => 4.0, 2 => 3.5, -2 => 3.0,
            3 => 2.5, -3 => 2.0, 4 => 1.5, -4 => 1.0,
        ];
        return $gapTable[$gap] ?? 1.0;
    }

    public function runSelection(string $sessionName, string $positionName): array
    {
        $target = DB::table('position_profiles')->where('position_name', $positionName)->first();
        $params = DB::table('dss_parameters')->first();

        if (!$target || !$params) return [];

        $assessments = Assessment::with('player')
            ->where('session_name', $sessionName)
            ->whereHas('player', function ($q) use ($positionName) {
                $q->where('position', $positionName);
            })->get();

        if ($assessments->isEmpty()) return [];

        $pmResults = [];

        foreach ($assessments as $assessment) {

// 1. ASPEK TEKNIK (CF: Passing, Controlling | SF: Dribbling)
$gapPassing     = $this->getGapWeight($assessment->passing - $target->target_passing);
$gapControlling = $this->getGapWeight($assessment->controlling - $target->target_controlling);
$gapDribbling   = $this->getGapWeight($assessment->dribbling - $target->target_dribbling);

$nCfTeknik = ($gapPassing + $gapControlling) / 2;
$nSfTeknik = $gapDribbling;
$nTeknik   = ($nCfTeknik * $params->core_factor_pct) + ($nSfTeknik * $params->secondary_factor_pct);

// 2. ASPEK FISIK (CF: Endurance, Speed | SF: Kelincahan)
$gapEndurance  = $this->getGapWeight($assessment->endurance - $target->target_endurance);
$gapSpeed      = $this->getGapWeight($assessment->speed - $target->target_speed);
$gapKelincahan = $this->getGapWeight($assessment->kelincahan - $target->target_kelincahan);

$nCfFisik = ($gapEndurance + $gapSpeed) / 2;
$nSfFisik = $gapKelincahan;
$nFisik   = ($nCfFisik * $params->core_factor_pct) + ($nSfFisik * $params->secondary_factor_pct);

// 3. ASPEK TAKTIK (Semua CF: Positioning, Pemahaman Taktik)
$gapPositioning = $this->getGapWeight($assessment->positioning - $target->target_positioning);
$gapTaktik      = $this->getGapWeight($assessment->pemahaman_taktik - $target->target_pemahaman_taktik);

$nTaktik = ($gapPositioning + $gapTaktik) / 2;

// 4. ASPEK MENTAL (CF: Mental Bertanding)
$gapMental = $this->getGapWeight($assessment->mental_bertanding - $target->target_mental_bertanding);

$nMental = $gapMental;

// 5. KRITERIA COST (Ketidakhadiran)
$nCost = 6 - $assessment->ketidakhadiran;

$pmResults[] = [
    'assessment_id' => $assessment->id,
    'player'        => $assessment->player,
    'teknik'        => $nTeknik,
    'fisik'         => $nFisik,
    'taktik'        => $nTaktik,
    'mental'        => $nMental,
    'cost'          => $nCost,
];

        }

        $sumTeknik = 0; $sumFisik = 0; $sumTaktik = 0; $sumMental = 0; $sumCost = 0;

        foreach ($pmResults as $res) {
            $sumTeknik += pow($res['teknik'], 2);
            $sumFisik += pow($res['fisik'], 2);
            $sumTaktik += pow($res['taktik'], 2);
            $sumMental += pow($res['mental'], 2);
            $sumCost += pow($res['cost'], 2);
        }

        $divTeknik = sqrt($sumTeknik);
        $divFisik = sqrt($sumFisik);
        $divTaktik = sqrt($sumTaktik);
        $divMental = sqrt($sumMental);
        $divCost = sqrt($sumCost);

        $finalResults = [];
        foreach ($pmResults as $res) {
            $normTeknik = $divTeknik == 0 ? 0 : $res['teknik'] / $divTeknik;
            $normFisik = $divFisik == 0 ? 0 : $res['fisik'] / $divFisik;
            $normTaktik = $divTaktik == 0 ? 0 : $res['taktik'] / $divTaktik;
            $normMental = $divMental == 0 ? 0 : $res['mental'] / $divMental;
            $normCost = $divCost == 0 ? 0 : $res['cost'] / $divCost;

            $benefit = ($normTeknik * $params->weight_technical) + 
                       ($normFisik * $params->weight_physical) + 
                       ($normTaktik * $params->weight_tactical) + 
                       ($normMental * $params->weight_mental);
                       
            $cost = ($normCost * $params->weight_ketidakhadiran);

            $y = $benefit - $cost;

            $finalResults[] = [
                'player_id' => $res['player']->id,
                'player_name' => $res['player']->name,
                'photo' => $res['player']->photo ?? null,
                'age_group' => $res['player']->age_group,
                'score' => round($y, 4),
                'stats' => [
                    'teknik' => round($res['teknik'], 2),
                    'fisik' => round($res['fisik'], 2),
                    'taktik' => round($res['taktik'], 2),
                    'mental' => round($res['mental'], 2),
                    'cost' => $res['cost'],
                ]
            ];
        }

        usort($finalResults, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $finalResults;
    }

    public function generateStartingXI(string $sessionName, string $formation): array
    {
        $formationsMap = [
            // 4 Bek
            '4-3-3' => ['Goalkeeper' => 1, 'Defender' => 4, 'Midfielder' => 3, 'Forward' => 3],
            '4-4-2' => ['Goalkeeper' => 1, 'Defender' => 4, 'Midfielder' => 4, 'Forward' => 2],
            '4-2-3-1' => ['Goalkeeper' => 1, 'Defender' => 4, 'Midfielder' => 5, 'Forward' => 1],
            '4-1-4-1' => ['Goalkeeper' => 1, 'Defender' => 4, 'Midfielder' => 5, 'Forward' => 1],
            '4-4-1-1' => ['Goalkeeper' => 1, 'Defender' => 4, 'Midfielder' => 5, 'Forward' => 1],
            '4-1-2-1-2' => ['Goalkeeper' => 1, 'Defender' => 4, 'Midfielder' => 4, 'Forward' => 2],
            '4-5-1' => ['Goalkeeper' => 1, 'Defender' => 4, 'Midfielder' => 5, 'Forward' => 1],
            
            // 3 Bek
            '3-5-2' => ['Goalkeeper' => 1, 'Defender' => 3, 'Midfielder' => 5, 'Forward' => 2],
            '3-4-3' => ['Goalkeeper' => 1, 'Defender' => 3, 'Midfielder' => 4, 'Forward' => 3],
            '3-4-2-1' => ['Goalkeeper' => 1, 'Defender' => 3, 'Midfielder' => 6, 'Forward' => 1],
            '3-1-4-2' => ['Goalkeeper' => 1, 'Defender' => 3, 'Midfielder' => 5, 'Forward' => 2],
            
            // 5 Bek
            '5-3-2' => ['Goalkeeper' => 1, 'Defender' => 5, 'Midfielder' => 3, 'Forward' => 2],
            '5-4-1' => ['Goalkeeper' => 1, 'Defender' => 5, 'Midfielder' => 4, 'Forward' => 1],
            '5-2-3' => ['Goalkeeper' => 1, 'Defender' => 5, 'Midfielder' => 2, 'Forward' => 3],
        ];

        $quota = $formationsMap[$formation] ?? $formationsMap['4-3-3'];
        
        $startingXI = [];
        
        $positions = ['Goalkeeper', 'Defender', 'Midfielder', 'Forward'];

        foreach ($positions as $position) {
            $rankedPlayers = $this->runSelection($sessionName, $position);

            $selectedPlayers = array_slice($rankedPlayers, 0, $quota[$position]);

            $startingXI[$position] = [
                'quota' => $quota[$position],
                'players' => $selectedPlayers
            ];
        }

        return $startingXI;
    }
}