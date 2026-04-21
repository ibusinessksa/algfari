<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\FundController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\OfferController;
use App\Http\Controllers\Api\V1\RegionController;
use App\Http\Controllers\Api\V1\SuggestionController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // ── Public reference (locations) ──
    Route::get('regions', [RegionController::class, 'index']);
    Route::get('cities', [CityController::class, 'index']);

    // ── Public (Auth) ──
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('send-otp', [AuthController::class, 'sendOtp']);
        Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
        Route::post('join-request', [AuthController::class, 'joinRequest']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
        Route::put('change-password', [AuthController::class, 'changePassword'])
            ->middleware('auth:sanctum');
        Route::post('logout', [AuthController::class, 'logout'])
            ->middleware('auth:sanctum');
    });

    // ── Protected ──
    Route::middleware('auth:sanctum')->group(function () {

        // Members
        Route::apiResource('members', MemberController::class)->only(['index', 'show', 'update']);
        Route::get('members/{member}/card', [MemberController::class, 'card']);

        // News
        Route::apiResource('news', NewsController::class)->only(['index', 'show']);

        // Events
        Route::apiResource('events', EventController::class)->only(['index', 'show']);
        Route::post('events/{event}/rsvp', [EventController::class, 'rsvp']);

        // Offers
        Route::apiResource('offers', OfferController::class)->only(['index', 'show']);

        // Family Fund
        Route::get('fund', [FundController::class, 'index']);
        Route::get('fund/summary', [FundController::class, 'summary']);

        // Suggestions
        Route::post('suggestions', [SuggestionController::class, 'store']);

        // Notifications
        Route::get('notifications', [NotificationController::class, 'index']);
        Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::put('notifications/read-all', [NotificationController::class, 'markAllAsRead']);

        // Device registration
        Route::post('devices', [MemberController::class, 'registerDevice']);
    });
});
