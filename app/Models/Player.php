<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'position',
        'age_group',
        'photo',
        'joined_season',
    ];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}