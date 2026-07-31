<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Public channels — live sport feeds for web + mobile (no auth required).
| Private/presence channels — only when a user model / Sanctum is available.
|
*/

// Public live feeds (MatchUpdated uses Channel, not PrivateChannel)
Broadcast::channel('matches', fn () => true);

Broadcast::channel('matches.{matchId}', fn ($user = null, $matchId = null) => true);

Broadcast::channel('sports.{sportId}.matches', fn ($user = null, $sportId = null) => true);

/*
| Example private channel (enable when User + auth is ready):
|
| Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
|     return (int) $user->id === (int) $id;
| });
*/
