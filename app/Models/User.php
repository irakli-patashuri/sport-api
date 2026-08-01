<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function displayName(): string
    {
        $name = trim(implode(' ', array_filter([$this->first_name, $this->last_name])));
        return $name !== '' ? $name : ($this->email ?: 'User');
    }

    public function toPublicArray(): array
    {
        return [
            'id' => (string) $this->id,
            'first_name' => $this->first_name ?: '',
            'last_name' => $this->last_name ?: '',
            'email' => $this->email,
            'display_name' => $this->displayName(),
            'is_anonymous' => false,
        ];
    }

    public function favorites()
    {
        return $this->hasMany(UserFavorite::class);
    }

    public function posts()
    {
        return $this->hasMany(SocialPost::class);
    }
}
