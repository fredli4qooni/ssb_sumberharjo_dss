<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Services\DSSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectionController extends Controller
{
    public function index(Request $request, DSSService $dssService)
    {
        $sessions = Assessment::select('session_name')->distinct()->pluck('session_name');
        
        $results = [];
        $selectedSession = $request->input('session_name');
        $selectedPosition = $request->input('position');

        if ($selectedSession && $selectedPosition) {
            $results = $dssService->runSelection($selectedSession, $selectedPosition);
        }

        return view('pelatih.selection.index', compact('sessions', 'results', 'selectedSession', 'selectedPosition'));
    }
}