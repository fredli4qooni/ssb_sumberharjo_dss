<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $coaches = User::where('role', 'pelatih')->latest()->paginate(10);

        $stats = [
            'total_coaches' => User::where('role', 'pelatih')->count(),
            'pro_licensed' => User::where('role', 'pelatih')->where('license_type', 'like', '%Pro%')->count(),
            'active_today' => User::where('role', 'pelatih')
                ->whereDate('last_login_at', \Carbon\Carbon::today())
                ->count(),
        ];

        return view('admin.users.index', compact('coaches', 'stats'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'license_type' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => 'pelatih', // Otomatis set sebagai pelatih
            'license_type' => $validated['license_type'],
            'password' => Hash::make($validated['password']),
            'status' => 'aktif',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun pelatih berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'license_type' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Data pelatih berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun pelatih berhasil dihapus.');
    }
}
