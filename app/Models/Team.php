<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    public $timestamps = false;

    protected $table = 'teams';

    protected $fillable = [
        'id',
        'name',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function homeMatches(): HasMany
    {
        return $this->hasMany(SportMatch::class, 'home_team_id');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(SportMatch::class, 'away_team_id');
    }
}
