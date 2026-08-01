<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialCommentLike extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = ['user_id', 'comment_id', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
