<?php

use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\LeagueController;
use App\Http\Controllers\Api\V1\MatchController;
use App\Http\Controllers\Api\V1\SportController;
use App\Http\Controllers\Api\V1\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sport API routes (mounted under /api/v1)
| JSON feed for web + mobile clients
| Data source: PostgreSQL sport_api (written by sport-node-api ingest)
|--------------------------------------------------------------------------
*/

Route::prefix('sports')->group(function () {
    Route::get('/', [SportController::class, 'index']);
    Route::get('/{id}', [SportController::class, 'show'])->whereNumber('id');
});

Route::prefix('countries')->group(function () {
    Route::get('/', [CountryController::class, 'index']);
    Route::get('/{id}', [CountryController::class, 'show'])->whereNumber('id');
});

Route::prefix('leagues')->group(function () {
    Route::get('/', [LeagueController::class, 'index']);
    Route::get('/{id}', [LeagueController::class, 'show'])->whereNumber('id');
});

Route::prefix('teams')->group(function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::get('/{id}', [TeamController::class, 'show'])->whereNumber('id');
});

Route::prefix('matches')->group(function () {
    Route::get('/', [MatchController::class, 'index']);
    Route::get('/{id}', [MatchController::class, 'show'])->whereNumber('id');
});
