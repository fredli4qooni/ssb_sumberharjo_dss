<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin IT',
            'email' => 'superadmin@sumberharjo.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Admin Akademi',
            'email' => 'admin@sumberharjo.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        User::create([
            'name' => 'Coach Budi (Pelatih Utama)',
            'email' => 'pelatih@sumberharjo.com',
            'password' => Hash::make('password'),
            'role' => 'pelatih',
            'license_type' => 'Lisensi A AFC',
            'status' => 'aktif',
        ]);

        DB::table('dss_parameters')->insert([
            'core_factor_pct' => 0.60,
            'secondary_factor_pct' => 0.40,
            'weight_physical' => 0.30,
            'weight_technical' => 0.45,
            'weight_tactical' => 0.25,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}