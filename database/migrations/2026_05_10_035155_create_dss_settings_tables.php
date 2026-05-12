<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('position_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('position_name');
            $table->integer('target_speed')->default(3);
            $table->integer('target_stamina')->default(3);
            $table->integer('target_strength')->default(3);
            $table->integer('target_passing')->default(3);
            $table->integer('target_dribbling')->default(3);
            $table->integer('target_shooting')->default(3);
            $table->integer('target_positioning')->default(3);
            $table->integer('target_vision')->default(3);
            $table->integer('target_cooperation')->default(3);
            $table->timestamps();
        });

        Schema::create('dss_parameters', function (Blueprint $table) {
            $table->id();
            $table->float('core_factor_pct')->default(0.60);
            $table->float('secondary_factor_pct')->default(0.40);
            $table->float('weight_physical')->default(0.30);
            $table->float('weight_technical')->default(0.45);
            $table->float('weight_tactical')->default(0.25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dss_parameters');
        Schema::dropIfExists('position_profiles');
    }
};