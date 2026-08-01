<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialPost extends Model
{
    protected $fillable = [
        'user_id',
        'kind',
        'body',
        'images',
        'match_id',
        'match_snapshot',
        'pick',
        'pick_odds',
        'pick_label',
        'stats',
        'prediction',
        'confidence',
        'likes_count',
        'comments_count',
        'shares_count',
    ];

    protected $casts = [
        'images' => 'array',
        'match_snapshot' => 'array',
        'stats' => 'array',
        'pick_odds' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(SocialComment::class, 'post_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(SocialPostLike::class, 'post_id');
    }
}
