<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\FavoriteController;
use App\Http\Controllers\Api\V1\Social\SocialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| App identity / social (NETSPOR)
|--------------------------------------------------------------------------
| Same path suffixes and JSON shapes as the former sport-node-api
| (/api/auth, /api/favorites, /api/social) so the mobile client can
| talk to Laravel sport-api instead.
*/

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('change-password', [AuthController::class, 'changePassword']);
    });
});

Route::prefix('favorites')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [FavoriteController::class, 'index']);
    Route::post('/', [FavoriteController::class, 'store']);
    Route::delete('{kind}/{targetId}', [FavoriteController::class, 'destroy']);
});

Route::prefix('social')->group(function () {
    Route::get('posts', [SocialController::class, 'listPosts'])->middleware('auth.optional');
    Route::get('posts/{id}', [SocialController::class, 'showPost'])->middleware('auth.optional');
    Route::get('posts/{id}/comments', [SocialController::class, 'listComments'])->middleware('auth.optional');
    Route::post('posts/{id}/share', [SocialController::class, 'sharePost'])->middleware('auth.optional');
    Route::get('users/{id}', [SocialController::class, 'showUser'])->middleware('auth.optional');
    Route::get('users/{id}/posts', [SocialController::class, 'listUserPosts'])->middleware('auth.optional');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('posts', [SocialController::class, 'createPost']);
        Route::delete('posts/{id}', [SocialController::class, 'deletePost']);
        Route::post('posts/{id}/like', [SocialController::class, 'togglePostLike']);
        Route::post('posts/{id}/comments', [SocialController::class, 'createComment']);
        Route::post('comments/{id}/like', [SocialController::class, 'toggleCommentLike']);
    });
});
