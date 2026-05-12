<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->integer('speed')->default(0)->after('session_name');
            $table->integer('stamina')->default(0)->after('speed');
            $table->integer('strength')->default(0)->after('stamina');
            
            $table->integer('passing')->default(0)->after('strength');
            $table->integer('dribbling')->default(0)->after('passing');
            $table->integer('shooting')->default(0)->after('dribbling');
            
            $table->integer('positioning')->default(0)->after('shooting');
            $table->integer('vision')->default(0)->after('positioning');
            $table->integer('cooperation')->default(0)->after('vision');
        });
    }

    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn(['speed', 'stamina', 'strength', 'passing', 'dribbling', 'shooting', 'positioning', 'vision', 'cooperation']);
        });
    }
};