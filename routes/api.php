<?php

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

// `app.secret` gates every /api/v1 route on the NETSPOR app's shared header
// (see VerifyAppClientSecret) — runs before auth:sanctum, so an endpoint
// isn't reachable at all from a browser tab or an unrelated client, whether
// or not it also requires a logged-in user.
Route::prefix('v1')->middleware('app.secret')->group(function () {
    require __DIR__.'/sport_routes.php';
    require __DIR__.'/app_routes.php';
});

Route::prefix('v2')->group(function () {
    // Breaking changes go here later.
});

/** Always-on health (no DB) — use this instead of GET / behind Apache Alias. */
Route::match(['GET', 'HEAD'], '/health', function () {
    return response()->json(['ok' => true, 'service' => 'sport-api']);
});

// Legacy auth group (existing app routes) — enable when controllers exist
// Route::prefix('auth')->group(__DIR__.'/auth_routes.php');
