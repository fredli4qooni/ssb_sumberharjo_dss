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
        return view('pelatih.assessments.create', compact('player'));
    }

    public function store(Request $request, Player $player)
    {
        $validated = $request->validate([
            'session_name' => 'required|string|max:255',
            'speed' => 'required|integer|between:1,5',
            'stamina' => 'required|integer|between:1,5',
            'strength' => 'required|integer|between:1,5',
            'passing' => 'required|integer|between:1,5',
            'dribbling' => 'required|integer|between:1,5',
            'shooting' => 'required|integer|between:1,5',
            'positioning' => 'required|integer|between:1,5',
            'vision' => 'required|integer|between:1,5',
            'cooperation' => 'required|integer|between:1,5',
            'coach_notes' => 'nullable|string',
        ]);

        $physical = round(($validated['speed'] + $validated['stamina'] + $validated['strength']) / 3, 2);
        $technical = round(($validated['passing'] + $validated['dribbling'] + $validated['shooting']) / 3, 2);
        $tactical = round(($validated['positioning'] + $validated['vision'] + $validated['cooperation']) / 3, 2);

        Assessment::create(array_merge($validated, [
            'player_id' => $player->id,
            'coach_id' => Auth::id(),
            'physical_score' => $physical,
            'technical_score' => $technical,
            'tactical_score' => $tactical,
        ]));

        
        /** @var \App\Models\User $coach */
        $coach = Auth::user();

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new AssessmentCompletedNotification($player, $coach));

        return redirect()->route('pelatih.assessments.index')->with('success', 'Penilaian untuk ' . $player->name . ' berhasil disimpan.');
    }
}
