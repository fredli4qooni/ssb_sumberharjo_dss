<?php

namespace App\Services;

use App\Models\Assessment;
use Illuminate\Support\Facades\DB;

class DSSService
{
    private function getGapWeight(int $gap): float
    {
        $gapTable = [
            0 => 5.0,  // Tidak ada selisih (Sesuai)
            1 => 4.5,  // Kompetensi individu kelebihan 1 tingkat
            -1 => 4.0, // Kompetensi individu kekurangan 1 tingkat
            2 => 3.5,  // Kelebihan 2 tingkat
            -2 => 3.0, // Kekurangan 2 tingkat
            3 => 2.5,  // Kelebihan 3 tingkat
            -3 => 2.0, // Kekurangan 3 tingkat
            4 => 1.5,  // Kelebihan 4 tingkat
            -4 => 1.0, // Kekurangan 4 tingkat
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

        $profileMatchingResults = [];

        foreach ($assessments as $assessment) {
            $gapSpeed = $this->getGapWeight($assessment->speed - $target->target_speed);
            $gapStamina = $this->getGapWeight($assessment->stamina - $target->target_stamina);
            $gapStrength = $this->getGapWeight($assessment->strength - $target->target_strength);
            $c1 = (($gapSpeed + $gapStamina) / 2 * $params->core_factor_pct) + ($gapStrength * $params->secondary_factor_pct);

            $gapPassing = $this->getGapWeight($assessment->passing - $target->target_passing);
            $gapDribbling = $this->getGapWeight($assessment->dribbling - $target->target_dribbling);
            $gapShooting = $this->getGapWeight($assessment->shooting - $target->target_shooting);
            $c2 = (($gapPassing + $gapDribbling) / 2 * $params->core_factor_pct) + ($gapShooting * $params->secondary_factor_pct);

            $gapPositioning = $this->getGapWeight($assessment->positioning - $target->target_positioning);
            $gapVision = $this->getGapWeight($assessment->vision - $target->target_vision);
            $gapCooperation = $this->getGapWeight($assessment->cooperation - $target->target_cooperation);
            $c3 = (($gapPositioning + $gapVision) / 2 * $params->core_factor_pct) + ($gapCooperation * $params->secondary_factor_pct);

            $profileMatchingResults[] = [
                'assessment_id' => $assessment->id,
                'player' => $assessment->player,
                'c1' => $c1,
                'c2' => $c2,
                'c3' => $c3,
            ];
        }

        $sumC1 = 0; $sumC2 = 0; $sumC3 = 0;
        foreach ($profileMatchingResults as $res) {
            $sumC1 += pow($res['c1'], 2);
            $sumC2 += pow($res['c2'], 2);
            $sumC3 += pow($res['c3'], 2);
        }
        $divC1 = sqrt($sumC1); $divC2 = sqrt($sumC2); $divC3 = sqrt($sumC3);

        $finalResults = [];
        foreach ($profileMatchingResults as $res) {
            $normC1 = $divC1 == 0 ? 0 : $res['c1'] / $divC1;
            $normC2 = $divC2 == 0 ? 0 : $res['c2'] / $divC2;
            $normC3 = $divC3 == 0 ? 0 : $res['c3'] / $divC3;

            $y = ($normC1 * $params->weight_physical) + 
                 ($normC2 * $params->weight_technical) + 
                 ($normC3 * $params->weight_tactical);

            $finalResults[] = [
                'player_name' => $res['player']->name,
                'age_group' => $res['player']->age_group,
                'score' => round($y, 4)
            ];
        }

        usort($finalResults, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $finalResults;
    }
}