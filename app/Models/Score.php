<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    public $timestamps = false;

    protected $table = 'scores';

    protected $primaryKey = 'match_id';

    public $incrementing = false;

    protected $fillable = [
        'match_id',
        'home_score',
        'away_score',
        'ht_home',
        'ht_away',
        'set2_home',
        'set2_away',
        'stoppage_first',
        'stoppage_second',
        'updated_at',
    ];

    protected $casts = [
        'match_id' => 'integer',
        'home_score' => 'integer',
        'away_score' => 'integer',
        'ht_home' => 'integer',
        'ht_away' => 'integer',
        'set2_home' => 'integer',
        'set2_away' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(SportMatch::class, 'match_id');
    }
}
