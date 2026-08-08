<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Eloquent model for `sportradar_tournaments` (written by sport-node-api's
 * Sportradar Gismo ingest). Read-only from sport-api's perspective.
 */
class SportradarTournament extends Model
{
    public $timestamps = false;

    protected $table = 'sportradar_tournaments';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'sport_id',
        'category_id',
        'category_name',
        'name',
        'raw',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'sport_id' => 'integer',
        'category_id' => 'integer',
        'raw' => 'array',
        'updated_at' => 'datetime',
    ];

    public function matches(): HasMany
    {
        return $this->hasMany(SportradarMatch::class, 'tournament_id');
    }
}
