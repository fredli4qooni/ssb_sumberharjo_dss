<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pelatih.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('users', 'public');
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
