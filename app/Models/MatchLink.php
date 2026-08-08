<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Eloquent model for `match_links` — the derived cross-reference between
 * `matches` (Swarm/BetConstruct feed) and `sportradar_matches` (Sportradar
 * Gismo feed), built by sport-node-api's lib/matchLinker.js from team-name +
 * kickoff-time similarity (the two providers share no common id).
 *
 * Treat a missing row as "no Sportradar enrichment yet" — never guess a link
 * on the sport-api side. `confidence` is kept for transparency/debugging,
 * not for additional filtering (sport-node-api already enforces a floor
 * before a row is written here).
 */
class MatchLink extends Model
{
    public $timestamps = false;

    protected $table = 'match_links';

    protected $primaryKey = 'swarm_match_id';

    public $incrementing = false;

    protected $fillable = [
        'swarm_match_id',
        'sportradar_match_id',
        'confidence',
        'matched_at',
    ];

    protected $casts = [
        'swarm_match_id' => 'integer',
        'sportradar_match_id' => 'integer',
        'confidence' => 'float',
        'matched_at' => 'datetime',
    ];

    public function swarmMatch(): BelongsTo
    {
        return $this->belongsTo(SportMatch::class, 'swarm_match_id');
    }

    public function sportradarMatch(): BelongsTo
    {
        return $this->belongsTo(SportradarMatch::class, 'sportradar_match_id');
    }
}
