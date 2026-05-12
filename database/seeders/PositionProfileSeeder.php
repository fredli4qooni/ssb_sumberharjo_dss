<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [
            [
                'position_name' => 'Forward',
                // Fisik
                'target_speed' => 5, 'target_stamina' => 4, 'target_strength' => 4,
                // Teknis
                'target_passing' => 3, 'target_dribbling' => 4, 'target_shooting' => 5,
                // Taktis
                'target_positioning' => 5, 'target_vision' => 3, 'target_cooperation' => 3,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'position_name' => 'Midfielder',
                // Fisik
                'target_speed' => 3, 'target_stamina' => 5, 'target_strength' => 3,
                // Teknis
                'target_passing' => 5, 'target_dribbling' => 4, 'target_shooting' => 3,
                // Taktis
                'target_positioning' => 4, 'target_vision' => 5, 'target_cooperation' => 5,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'position_name' => 'Defender',
                // Fisik
                'target_speed' => 4, 'target_stamina' => 4, 'target_strength' => 5,
                // Teknis
                'target_passing' => 3, 'target_dribbling' => 2, 'target_shooting' => 2,
                // Taktis
                'target_positioning' => 5, 'target_vision' => 3, 'target_cooperation' => 4,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'position_name' => 'Goalkeeper',
                // Fisik
                'target_speed' => 3, 'target_stamina' => 3, 'target_strength' => 4,
                // Teknis
                'target_passing' => 3, 'target_dribbling' => 1, 'target_shooting' => 1,
                // Taktis
                'target_positioning' => 5, 'target_vision' => 4, 'target_cooperation' => 4,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ];

        DB::table('position_profiles')->insert($profiles);
    }
}