<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Eloquent model for the `matches` table.
 * Named SportMatch to avoid clashing with Illuminate\Support\Match / PHP keywords.
 */
class SportMatch extends Model
{
    public $timestamps = false;

    protected $table = 'matches';

    protected $fillable = [
        'id',
        'sport_id',
        'country_id',
        'league_id',
        'home_team_id',
        'away_team_id',
        'home_team_name',
        'away_team_name',
        'start_ts',
        'starts_at',
        'match_type',
        'is_live',
        'is_blocked',
        'sport_alias',
        'markets_count',
        'game_state',
        'game_time',
        'add_minutes',
        'add_info',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'sport_id' => 'integer',
        'country_id' => 'integer',
        'league_id' => 'integer',
        'home_team_id' => 'integer',
        'away_team_id' => 'integer',
        'start_ts' => 'integer',
        'starts_at' => 'datetime',
        'match_type' => 'integer',
        'is_live' => 'boolean',
        'is_blocked' => 'boolean',
        'markets_count' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function score(): HasOne
    {
        return $this->hasOne(Score::class, 'match_id');
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class, 'match_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(MatchEvent::class, 'match_id');
    }
}
