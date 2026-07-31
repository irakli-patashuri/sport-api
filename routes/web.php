<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
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
