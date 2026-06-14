<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Services\DSSService;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    public function index(Request $request, DSSService $dssService)
    {
        $sessions = Assessment::select('session_name')->distinct()->pluck('session_name');
        
        $formations = ['4-3-3', '4-4-2', '3-5-2', '4-2-3-1'];

        $mode = $request->input('mode', 'ranking');
        $selectedSession = $request->input('session_name');
        $selectedPosition = $request->input('position');
        $selectedFormation = $request->input('formation');

        $results = [];
        $startingXI = [];

        if ($selectedSession) {
            if ($mode === 'ranking' && $selectedPosition) {
                $results = $dssService->runSelection($selectedSession, $selectedPosition);
            } elseif ($mode === 'starting_xi' && $selectedFormation) {
                $startingXI = $dssService->generateStartingXI($selectedSession, $selectedFormation);
            }
        }

        return view('pelatih.selection.index', compact(
            'sessions', 
            'formations', 
            'mode', 
            'results', 
            'startingXI', 
            'selectedSession', 
            'selectedPosition', 
            'selectedFormation'
        ));
    }
}