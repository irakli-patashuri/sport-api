<?php

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\CoinController;
use App\Http\Controllers\User\FavoriteGameController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserHistoryController;
use App\Http\Controllers\User\VerificationController;
use App\Http\Controllers\User\BonusController;
use App\Http\Middleware\UpdateLastActivity;

use Illuminate\Support\Facades\Route;
// For user
Route::middleware(['auth:sanctum', 'UpdateLastActivity'])->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/get', [UserController::class, 'getUserData']);
        
        Route::get('/bonus-balance-detail-information', [UserController::class, 'bonusBalanceDetailInformation']);
        Route::get('/get-notes', [UserController::class, 'getNotes']);
        Route::delete('/delete-note/{id}', [UserController::class, 'destroyNote']);
        Route::get('/read-note/{id}', [UserController::class, 'readNote']);

        Route::get('/get-user-free-spins', [UserController::class, 'getUserFreeSpins']);
        Route::put('/change-password', [UserController::class, 'changePassword']);
        Route::put('/change-email', [UserController::class, 'changeEmail']);
        Route::put('/change-mobile', [UserController::class, 'changeMobile']);
        Route::put('/change-address', [UserController::class, 'changeAddress']);  
        Route::prefix('/history')->group(function () {
            Route::get('/login', [UserHistoryController::class, 'loginHistory']);
            Route::get('/financial', [UserHistoryController::class, 'financialHistory']);  
            Route::get('/game', [UserHistoryController::class, 'gameHistory']);
            Route::get('/user-to-user-transactions', [UserHistoryController::class, 'userToUserTransactions']);
            Route::get('/bonuses', [UserHistoryController::class, 'getUserBonuses']);
        });
        Route::post('/toggle-favorite-game', [FavoriteGameController::class, 'toggleFavoriteGame'])->name('addGameToFavorites');
        Route::get('/get-all-favorite-games', [FavoriteGameController::class, 'getAllFavoriteGames'])->name('getAllFavoriteGames');
        Route::post('/send-money-to-friend', [UserController::class, 'sendMoneyToFriend'])->name('sendMoneyToFriend');  
        
        // For 2fa google auth
        Route::post('/two-fa-google-enable', [UserController::class, 'twoFaGoogleEnable']);
        Route::post('/two-fa-google-disable', [UserController::class, 'twoFaGoogleDisable']);
        Route::get('/two-fa-google-check', [UserController::class, 'twoFaGoogleCheck']);

        // for email 2fa
        Route::post('/two-fa-email-enable', [UserController::class, 'enableEmailTwoFa']);
        Route::post('/two-fa-email-disable', [UserController::class, 'disableEmailTwoFa']);
        Route::get('/two-fa-email-check', [UserController::class, 'checkEmailTwoFa']);

        // Others
        Route::get('/recently-played', [UserController::class, 'RecentlyPlayed']);
        Route::post('/update-account', [UserController::class, 'updateAccount']);
        Route::post('/update-account-once', [UserController::class, 'updateAccountOnce']);

        // For verification
        Route::post('/send-email-verification-code', [VerificationController::class, 'SendEmailVerificationCode']);
        Route::post('/check-email-verification-code', [VerificationController::class, 'CheckEmailVerificationCode']);
        Route::get('/pending-transaction', [UserController::class, 'checkPendingTransaction']);
        Route::get('/pending-deposit-transaction', [UserController::class, 'checkPendingDepositTransaction']);
        Route::post('/cancel-transaction', [UserController::class, 'cancelTransaction']);
        Route::post('/cancel-deposit-transaction', [UserController::class, 'cancelDepositTransaction']);
        Route::get('/get-payment-transaction-detail-data/{id}', [UserController::class, 'getPaymentTransactionDetailData']);

        Route::get('/coins', [CoinController::class, 'index']);
        Route::post('/coins/add', [CoinController::class, 'addCoin']);

    });
    Route::get('/bonuses', [BonusController::class, 'getBonuses']);
    Route::post('/claim-daily-bonus/{id}', [BonusController::class, 'claimDailyBonus']);
    Route::get('/check-mega-bonus', [BonusController::class, 'checkMegaBonus']);
});
Route::get('/top-100-leader', [BonusController::class, 'top100LeadersBoard']);
Route::post('/user/send-reset-link', [AuthController::class, 'sendResetLink']);
Route::post('/user/password-reset', [AuthController::class, 'resetPassword']);