<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\NewPlayerNotification;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::latest()->paginate(10);
        return view('admin.players.index', compact('players'));
    }

    public function create()
    {
        return view('admin.players.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'position' => 'required|string',
            'age_group' => 'required|string',
            'joined_season' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('players', 'public');
        }

        $player = \App\Models\Player::create($validatedData);

        $coaches = \App\Models\User::where('role', 'pelatih')->get();
        \Illuminate\Support\Facades\Notification::send($coaches, new \App\Notifications\NewPlayerNotification($player));

        return redirect()->route('admin.players.index')->with('success', 'Data pemain berhasil ditambahkan.');
    }

    public function edit(Player $player)
    {
        return view('admin.players.edit', compact('player'));
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'position' => 'required|string',
            'age_group' => 'required|string',
            'joined_season' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($player->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($player->photo);
            }
            $validated['photo'] = $request->file('photo')->store('players', 'public');
        }

        $player->update($validated);

        return redirect()->route('admin.players.index')->with('success', 'Data pemain berhasil diperbarui.');
    }

    public function destroy(Player $player)
    {
        if ($player->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($player->photo);
        }
        $player->delete();
        return redirect()->route('admin.players.index')->with('success', 'Data pemain berhasil dihapus.');
    }
}
