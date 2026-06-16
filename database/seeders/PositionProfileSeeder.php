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
                'target_speed' => 5, 'target_endurance' => 3, 'target_kelincahan' => 3,
                // Teknis
                'target_passing' => 3, 'target_controlling' => 3, 'target_dribbling' => 4,
                // Taktis
                'target_positioning' => 5, 'target_pemahaman_taktik' => 3,
                // Mental
                'target_mental_bertanding' => 3,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'position_name' => 'Midfielder',
                // Fisik
                'target_speed' => 3, 'target_endurance' => 3, 'target_kelincahan' => 3,
                // Teknis
                'target_passing' => 5, 'target_controlling' => 3, 'target_dribbling' => 4,
                // Taktis
                'target_positioning' => 4, 'target_pemahaman_taktik' => 3,
                // Mental
                'target_mental_bertanding' => 3,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'position_name' => 'Defender',
                // Fisik
                'target_speed' => 4, 'target_endurance' => 3, 'target_kelincahan' => 3,
                // Teknis
                'target_passing' => 3, 'target_controlling' => 3, 'target_dribbling' => 2,
                // Taktis
                'target_positioning' => 5, 'target_pemahaman_taktik' => 3,
                // Mental
                'target_mental_bertanding' => 3,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'position_name' => 'Goalkeeper',
                // Fisik
                'target_speed' => 3, 'target_endurance' => 3, 'target_kelincahan' => 3,
                // Teknis
                'target_passing' => 3, 'target_controlling' => 3, 'target_dribbling' => 1,
                // Taktis
                'target_positioning' => 5, 'target_pemahaman_taktik' => 3,
                // Mental
                'target_mental_bertanding' => 3,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ];

        DB::table('position_profiles')->insert($profiles);
    }
}