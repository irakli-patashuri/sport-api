<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    public $timestamps = false;

    protected $table = 'statistics';

    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'match_id',
        'stat_key',
        'home_value',
        'away_value',
        'updated_at',
    ];

    protected $casts = [
        'match_id' => 'integer',
        'home_value' => 'float',
        'away_value' => 'float',
        'updated_at' => 'datetime',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(SportMatch::class, 'match_id');
    }
}
