<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('position_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'target_stamina', 
                'target_strength', 
                'target_shooting', 
                'target_vision', 
                'target_cooperation'
            ]);
            
            $table->integer('target_controlling')->default(3)->after('target_passing');
            $table->integer('target_endurance')->default(3)->after('target_speed');
            $table->integer('target_kelincahan')->default(3)->after('target_endurance');
            $table->integer('target_pemahaman_taktik')->default(3)->after('target_positioning');
            $table->integer('target_mental_bertanding')->default(3)->after('target_pemahaman_taktik');
        });

        Schema::table('dss_parameters', function (Blueprint $table) {
            $table->float('weight_mental')->default(0.15)->after('weight_tactical');
            $table->float('weight_ketidakhadiran')->default(0.15)->after('weight_mental');
        });

        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn([
                'stamina', 
                'strength', 
                'shooting', 
                'vision', 
                'cooperation'
            ]);

            $table->integer('controlling')->default(0)->after('passing');
            $table->integer('endurance')->default(0)->after('speed');
            $table->integer('kelincahan')->default(0)->after('endurance');
            $table->integer('pemahaman_taktik')->default(0)->after('positioning');
            $table->integer('mental_bertanding')->default(0)->after('pemahaman_taktik');
            
            $table->integer('ketidakhadiran')->default(0)->after('mental_bertanding');

            $table->float('mental_score')->nullable()->after('tactical_score');
        });
    }

    public function down(): void
    {
    }
};