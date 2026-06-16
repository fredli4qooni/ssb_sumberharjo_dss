<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DssController extends Controller
{
    public function index()
    {
        $settings = DB::table('dss_parameters')->first();
        
        $profiles = DB::table('position_profiles')->get();

        return view('admin.dss.index', compact('settings', 'profiles'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'core_factor_pct' => 'required|numeric',
            'secondary_factor_pct' => 'required|numeric',
            'weight_physical' => 'required|numeric',
            'weight_technical' => 'required|numeric',
            'weight_tactical' => 'required|numeric',
            'weight_mental' => 'required|numeric',
            'weight_ketidakhadiran' => 'required|numeric',
        ]);

        DB::table('dss_parameters')->where('id', 1)->update($validated);

        return redirect()->back()->with('success', 'Parameter PM-MOORA berhasil diperbarui.');
    }

    public function updateProfile(Request $request, int $id)
    {
        $validated = $request->validate([
            'target_endurance' => 'required|integer|between:1,5',
            'target_speed' => 'required|integer|between:1,5',
            'target_kelincahan' => 'required|integer|between:1,5',
            'target_passing' => 'required|integer|between:1,5',
            'target_controlling' => 'required|integer|between:1,5',
            'target_dribbling' => 'required|integer|between:1,5',
            'target_positioning' => 'required|integer|between:1,5',
            'target_pemahaman_taktik' => 'required|integer|between:1,5',
            'target_mental_bertanding' => 'required|integer|between:1,5',
        ]);

        DB::table('position_profiles')->where('id', $id)->update($validated);

        return redirect()->back()->with('success', 'Target Kriteria untuk posisi tersebut berhasil diperbarui.');
    }
}