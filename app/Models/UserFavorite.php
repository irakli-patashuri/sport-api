<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'kind',
        'target_id',
        'meta',
        'created_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'created_at' => 'datetime',
    ];

    public function toApiArray(): array
    {
        return [
            'id' => (string) $this->id,
            'kind' => $this->kind,
            'target_id' => $this->target_id,
            'meta' => $this->meta ?: (object) [],
            'created_at' => optional($this->created_at)?->toISOString(),
        ];
    }
}
