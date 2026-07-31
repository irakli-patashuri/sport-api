<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sport extends Model
{
    public $timestamps = false;

    protected $table = 'sports';

    protected $fillable = [
        'id',
        'name',
        'alias',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function leagues(): HasMany
    {
        return $this->hasMany(League::class, 'sport_id');
    }

    public function matches(): HasMany
    {
        return $this->hasMany(SportMatch::class, 'sport_id');
    }
}
