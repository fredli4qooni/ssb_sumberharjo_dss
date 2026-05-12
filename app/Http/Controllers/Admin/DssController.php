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
        return view('admin.dss.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'core_factor_pct' => 'required|numeric',
            'secondary_factor_pct' => 'required|numeric',
            'weight_physical' => 'required|numeric',
            'weight_technical' => 'required|numeric',
            'weight_tactical' => 'required|numeric',
        ]);

        DB::table('dss_parameters')->where('id', 1)->update($validated);

        return redirect()->back()->with('success', 'Parameter DSS berhasil diperbarui.');
    }
}
