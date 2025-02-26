<?php

use Illuminate\Support\Facades\Route;
//require __DIR__.'/auth_routes.php';
require __DIR__.'/user_routes.php'; 
require __DIR__.'/site_routes.php'; 
require __DIR__.'/payment_routes.php'; 
require __DIR__.'/dev_routes.php';  
require __DIR__.'/game_routes.php';
require __DIR__.'/affiliates_routes.php';
require __DIR__.'/admin_api_routes.php';
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

route::prefix("auth")->group(__DIR__.'/auth_routes.php');
