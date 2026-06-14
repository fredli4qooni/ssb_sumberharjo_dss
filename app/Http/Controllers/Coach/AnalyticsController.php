<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $players = Player::withCount('assessments')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12);

        return view('pelatih.analytics.index', compact('players', 'search'));
    }

    public function show(Player $player)
    {
        $assessments = Assessment::where('player_id', $player->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $labels = $assessments->pluck('session_name');
        $physicalTrend = $assessments->pluck('physical_score');
        $technicalTrend = $assessments->pluck('technical_score');
        $tacticalTrend = $assessments->pluck('tactical_score');

        $latest = $assessments->last();
        $radarData = [];
        if ($latest) {
            $radarData = [
                $latest->endurance,
                $latest->speed,
                $latest->kelincahan,
                $latest->passing,
                $latest->controlling,
                $latest->dribbling,
                $latest->positioning,
                $latest->pemahaman_taktik,
                $latest->mental_bertanding
            ];
        }

        return view('pelatih.analytics.show', compact(
            'player',
            'assessments',
            'labels',
            'physicalTrend',
            'technicalTrend',
            'tacticalTrend',
            'radarData',
            'latest'
        ));
    }

    public function downloadPdf(Player $player)
    {
        $assessments = Assessment::where('player_id', $player->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $latest = $assessments->first();

        $stats = [
            'avg_physical' => round($assessments->avg('physical_score'), 2),
            'avg_technical' => round($assessments->avg('technical_score'), 2),
            'avg_tactical' => round($assessments->avg('tactical_score'), 2),
            'avg_mental' => round($assessments->avg('mental_score'), 2),
        ];

        $pdf = Pdf::loadView('pelatih.analytics.report_pdf', compact('player', 'assessments', 'latest', 'stats'));

        return $pdf->download('Laporan_Performa_' . str_replace(' ', '_', $player->name) . '.pdf');
    }
}