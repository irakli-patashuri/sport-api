<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Public health/info for subdirectory installs (Apache Alias).
| Use match GET+HEAD — some proxies probe with HEAD only.
|
*/

Route::match(['GET', 'HEAD'], '/', function () {
    return response()->json([
        'success' => true,
        'data' => [
            'name' => 'sport-api',
            'docs' => [
                'v1' => url('/api/v1/countries'),
            ],
        ],
        'message' => 'Sport API',
    ]);
});
