<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\AssessmentCompletedNotification;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $ageGroup = $request->input('age_group');

        $players = Player::withCount('assessments')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($ageGroup, function ($query, $ageGroup) {
                return $query->where('age_group', $ageGroup);
            })
            ->latest()
            ->paginate(15);

        return view('pelatih.assessments.index', compact('players', 'search', 'ageGroup'));
    }

    public function create(Player $player)
    {
        $assessments = $player->assessments()->latest()->get();
        return view('pelatih.assessments.create', compact('player', 'assessments'));
    }

    public function store(Request $request, Player $player)
    {
        $validated = $request->validate([
            'session_name' => 'required|string|max:255',
            'speed' => 'required|integer|between:1,5',
            'endurance' => 'required|integer|between:1,5',
            'kelincahan' => 'required|integer|between:1,5',
            'passing' => 'required|integer|between:1,5',
            'controlling' => 'required|integer|between:1,5',
            'dribbling' => 'required|integer|between:1,5',
            'positioning' => 'required|integer|between:1,5',
            'pemahaman_taktik' => 'required|integer|between:1,5',
            'mental_bertanding' => 'required|integer|between:1,5',
            'ketidakhadiran' => 'required|integer|min:0',
            'coach_notes' => 'nullable|string',
        ]);

        $physical = round(($validated['speed'] + $validated['endurance'] + $validated['kelincahan']) / 3, 2);
        $technical = round(($validated['passing'] + $validated['controlling'] + $validated['dribbling']) / 3, 2);
        $tactical = round(($validated['positioning'] + $validated['pemahaman_taktik']) / 2, 2);
        $mental = round($validated['mental_bertanding'], 2);

        Assessment::create(array_merge($validated, [
            'player_id' => $player->id,
            'coach_id' => Auth::id(),
            'physical_score' => $physical,
            'technical_score' => $technical,
            'tactical_score' => $tactical,
            'mental_score' => $mental,
        ]));

        /** @var \App\Models\User $coach */
        $coach = Auth::user();

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new \App\Notifications\AssessmentCompletedNotification($player, $coach));

        return redirect()->route('pelatih.assessments.index')->with('success', 'Penilaian untuk ' . $player->name . ' berhasil disimpan.');
    }

    public function destroy(Assessment $assessment)
    {
        $assessment->delete();

        return back()->with('success', 'Data penilaian berhasil dihapus.');
    }
}
