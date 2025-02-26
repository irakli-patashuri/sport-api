<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// AuthController
Route::post('/login', [AuthController::class, 'login'])->middleware(['throttle:5,1']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/quick-register', [AuthController::class, 'quickRegister']);
Route::post('/full-register', [AuthController::class, 'register']);
Route::post('/forgot', [AuthController::class, 'forgot']);
Route::post('/reset', [AuthController::class, 'reset']);
