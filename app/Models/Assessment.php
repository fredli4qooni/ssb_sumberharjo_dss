<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'coach_id',
        'session_name',
        'speed',
        'stamina',
        'strength',
        'passing',
        'dribbling',
        'shooting',
        'positioning',
        'vision',
        'cooperation',
        'physical_score',
        'technical_score',
        'tactical_score',
        'coach_notes',
        'aggregate_score',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}
