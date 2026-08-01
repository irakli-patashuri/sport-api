<?php

// TEST FOR DEPLOY 

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Versioned API surface:
|   /api/v1/...
|   /api/v2/...
|
*/

Route::prefix('v1')->group(function () {
    require __DIR__.'/sport_routes.php';
    require __DIR__.'/app_routes.php';
});

Route::prefix('v2')->group(function () {
    // Breaking changes go here later.
});

// Legacy auth group (existing app routes) — enable when controllers exist
// Route::prefix('auth')->group(__DIR__.'/auth_routes.php');
