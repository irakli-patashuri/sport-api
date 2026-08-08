<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Eloquent model for `sportradar_match_timeline` (written by sport-node-api).
 * Read-only from sport-api's perspective. Only has `created_at`, not
 * `updated_at` — hence $timestamps = false and a manual cast.
 */
class SportradarMatchTimeline extends Model
{
    public $timestamps = false;

    protected $table = 'sportradar_match_timeline';

    protected $fillable = [
        'id',
        'match_id',
        'event_type',
        'match_time',
        'period',
        'team',
        'player_name',
        'description',
        'event_seq',
        'raw',
        'created_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'match_id' => 'integer',
        'event_seq' => 'integer',
        'raw' => 'array',
        'created_at' => 'datetime',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(SportradarMatch::class, 'match_id');
    }
}
