<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'fixture_id',
        'player_id',
        'team_id',
        'minute',
        'goal_type'
    ];

    // Relationships
    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Helper Methods
    public function getGoalTypeLabel()
    {
        $types = [
            'normal' => '⚽ Normal',
            'penalty' => '⚡ Penalty',
            'own_goal' => '😓 Own Goal'
        ];

        return $types[$this->goal_type] ?? 'Normal';
    }

    public function isOwnGoal()
    {
        return $this->goal_type === 'own_goal';
    }

    public function isPenalty()
    {
        return $this->goal_type === 'penalty';
    }

    public function scopeNormal($query)
    {
        return $query->where('goal_type', 'normal');
    }

    public function scopePenalties($query)
    {
        return $query->where('goal_type', 'penalty');
    }

    public function scopeOwnGoals($query)
    {
        return $query->where('goal_type', 'own_goal');
    }
}