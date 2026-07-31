<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    public $timestamps = false;

    protected $table = 'countries';

    protected $fillable = [
        'id',
        'name',
        'alias',
        'sort_order',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'sort_order' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function leagues(): HasMany
    {
        return $this->hasMany(League::class, 'country_id');
    }

    public function matches(): HasMany
    {
        return $this->hasMany(SportMatch::class, 'country_id');
    }
}
