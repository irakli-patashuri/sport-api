<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Eloquent model for `sportradar_matches` (written by sport-node-api's
 * Sportradar Gismo ingest — separate id space from `matches`/SportMatch,
 * see MatchLink for the name+kickoff-time derived cross-reference).
 * Read-only from sport-api's perspective.
 */
class SportradarMatch extends Model
{
    public $timestamps = false;

    protected $table = 'sportradar_matches';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'sport_id',
        'tournament_id',
        'home_team_id',
        'away_team_id',
        'home_team_name',
        'away_team_name',
        'status_id',
        'status_name',
        'home_score',
        'away_score',
        'match_time',
        'period',
        'starts_at',
        'match_date',
        'page',
        'is_live',
        'raw',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'sport_id' => 'integer',
        'tournament_id' => 'integer',
        'home_team_id' => 'integer',
        'away_team_id' => 'integer',
        'status_id' => 'integer',
        'home_score' => 'integer',
        'away_score' => 'integer',
        'starts_at' => 'datetime',
        'match_date' => 'date',
        'page' => 'integer',
        'is_live' => 'boolean',
        'raw' => 'array',
        'updated_at' => 'datetime',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(SportradarTournament::class, 'tournament_id');
    }

    public function timeline(): HasMany
    {
        return $this->hasMany(SportradarMatchTimeline::class, 'match_id')
            ->orderBy('event_seq');
    }

    public function link(): HasOne
    {
        return $this->hasOne(MatchLink::class, 'sportradar_match_id');
    }
}
