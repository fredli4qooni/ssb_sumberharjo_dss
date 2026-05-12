<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\User;
use App\Models\Assessment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_players' => Player::count(),
            'total_coaches' => User::where('role', 'pelatih')->count(),
            'total_assessments' => Assessment::count(),
            'latest_players' => Player::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}