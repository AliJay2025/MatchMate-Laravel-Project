<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'match_date',
        'venue',
        'home_score',
        'away_score',
        'status',
        'match_report'
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];

    // Relationships
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    // Helper Methods
    public function isPlayed()
    {
        return $this->status === 'played';
    }

    public function isScheduled()
    {
        return $this->status === 'scheduled';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function getWinner()
    {
        if (!$this->isPlayed()) {
            return null;
        }
        
        if ($this->home_score > $this->away_score) {
            return $this->homeTeam;
        } elseif ($this->away_score > $this->home_score) {
            return $this->awayTeam;
        }
        
        return null; // Draw
    }

    public function getResultText()
    {
        if (!$this->isPlayed()) {
            return 'Not Played Yet';
        }
        return $this->home_score . ' - ' . $this->away_score;
    }

    public function getFullResult()
    {
        if (!$this->isPlayed()) {
            return 'vs';
        }
        return $this->homeTeam->name . ' ' . $this->home_score . ' - ' . $this->away_score . ' ' . $this->awayTeam->name;
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
                     ->where('match_date', '>=', now())
                     ->orderBy('match_date', 'asc');
    }

    public function scopePlayed($query)
    {
        return $query->where('status', 'played')
                     ->orderBy('match_date', 'desc');
    }
}