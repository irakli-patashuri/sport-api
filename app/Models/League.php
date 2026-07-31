<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    public $timestamps = false;

    protected $table = 'leagues';

    protected $fillable = [
        'id',
        'sport_id',
        'country_id',
        'name',
        'sort_order',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'sport_id' => 'integer',
        'country_id' => 'integer',
        'sort_order' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function matches(): HasMany
    {
        return $this->hasMany(SportMatch::class, 'league_id');
    }
}
