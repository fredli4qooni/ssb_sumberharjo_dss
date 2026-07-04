<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'theme_color' => 'required|in:orange,blue,green,red',
            'app_logo' => 'nullable|image|max:2048',
        ]);

        $setting = Setting::first() ?? new Setting();
        $setting->app_name = $request->app_name;
        $setting->theme_color = $request->theme_color;

        if ($request->hasFile('app_logo')) {
            if ($setting->app_logo) {
                Storage::disk('public')->delete($setting->app_logo);
            }
            $setting->app_logo = $request->file('app_logo')->store('settings', 'public');
        }

        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan aplikasi berhasil diperbarui.');
    }
}
