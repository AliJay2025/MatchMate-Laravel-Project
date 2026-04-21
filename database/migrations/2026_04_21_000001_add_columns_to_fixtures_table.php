<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fixtures', function (Blueprint $table) {
            if (!Schema::hasColumn('fixtures', 'home_team_id')) {
                $table->foreignId('home_team_id')->constrained('teams')->onDelete('cascade');
            }
            if (!Schema::hasColumn('fixtures', 'away_team_id')) {
                $table->foreignId('away_team_id')->constrained('teams')->onDelete('cascade');
            }
            if (!Schema::hasColumn('fixtures', 'match_date')) {
                $table->dateTime('match_date');
            }
            if (!Schema::hasColumn('fixtures', 'venue')) {
                $table->string('venue')->nullable();
            }
            if (!Schema::hasColumn('fixtures', 'home_score')) {
                $table->integer('home_score')->nullable();
            }
            if (!Schema::hasColumn('fixtures', 'away_score')) {
                $table->integer('away_score')->nullable();
            }
            if (!Schema::hasColumn('fixtures', 'status')) {
                $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');
            }
        });
    }

    public function down(): void
    {
        Schema::table('fixtures', function (Blueprint $table) {
            $table->dropColumn([
                'home_team_id', 'away_team_id', 'match_date', 
                'venue', 'home_score', 'away_score', 'status'
            ]);
        });
    }
};