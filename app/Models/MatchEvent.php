<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchEvent extends Model
{
    public $timestamps = false;

    protected $table = 'match_events';

    protected $fillable = [
        'id',
        'match_id',
        'type_id',
        'side',
        'minute',
        'period_sequence',
        'event_value',
        'event_ts',
        'event_at',
        'time_utc_raw',
    ];

    protected $casts = [
        'id' => 'integer',
        'match_id' => 'integer',
        'type_id' => 'integer',
        'side' => 'integer',
        'period_sequence' => 'integer',
        'event_value' => 'float',
        'event_ts' => 'integer',
        'event_at' => 'datetime',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(SportMatch::class, 'match_id');
    }
}
