<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\FaqController;
use App\Http\Controllers\Api\V1\TestFcmController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\FavoriteController;
use App\Http\Controllers\Api\V1\FundController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\ChildController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\NewsCommentController;
use App\Http\Controllers\Api\V1\NewsReactionController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\OfferController;
use App\Http\Controllers\Api\V1\RegionController;
use App\Http\Controllers\Api\V1\SearchController;
use App\Http\Controllers\Api\V1\SuggestionController;
use App\Http\Controllers\Api\V1\VisitorController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // ── Health check ──
    Route::get('health', fn () => response()->json([
        'status' => 'ok',
        'time' => now()->toISOString(),
    ]));

    // ── Test FCM (dev only) ──
    Route::post('test-fcm', [TestFcmController::class, 'send']);

    // ── Public reference (locations) ──
    Route::get('regions', [RegionController::class, 'index']);
    Route::get('cities', [CityController::class, 'index']);
    Route::get('contact-info', [ContactController::class, 'index']);
    Route::get('faqs', [FaqController::class, 'index']);

    // ── Visitors ──
    Route::post('visitors', [VisitorController::class, 'increment']);
    Route::get('visitors', [VisitorController::class, 'show']);

    // ── Public (Auth) ──
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->middleware('throttle:login');
        Route::post('send-otp', [AuthController::class, 'sendOtp'])->middleware('throttle:auth-sensitive');
        Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->middleware('throttle:auth-sensitive');
        Route::post('join-request', [AuthController::class, 'joinRequest'])->middleware('throttle:auth-sensitive');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])->middleware('throttle:auth-sensitive');
        Route::put('change-password', [AuthController::class, 'changePassword'])
            ->middleware('auth:sanctum');
        Route::post('send-email-verification', [AuthController::class, 'sendEmailVerification'])
            ->middleware('auth:sanctum');
        Route::post('verify-email', [AuthController::class, 'verifyEmailCode'])
            ->middleware('auth:sanctum');
        Route::post('send-email-verification-link', [AuthController::class, 'sendEmailVerificationLink'])
            ->middleware('auth:sanctum');
        Route::get('email/verify-link/{user}', [AuthController::class, 'verifyEmailLink'])
            ->name('api.email.verify-link');
        Route::post('forgot-password/email', [AuthController::class, 'forgotPasswordEmail'])
            ->middleware('throttle:auth-sensitive');
        Route::post('password/reset-link/{user}', [AuthController::class, 'resetPasswordViaLink'])
            ->name('api.password.reset-link');
        Route::post('logout', [AuthController::class, 'logout'])
            ->middleware('auth:sanctum');
    });

    // ── Protected ──
    Route::middleware('auth:sanctum')->group(function () {

        // Home aggregate
        Route::get('home', [HomeController::class, 'index']);

        // Profile (authenticated user)
        Route::get('profile', [MemberController::class, 'profile']);
        Route::put('profile', [MemberController::class, 'updateProfile']);

        // Members children (must come before apiResource('members') to avoid {member} capturing "children")
        Route::get('members/children', [ChildController::class, 'index']);
        Route::post('members/children', [ChildController::class, 'store']);
        Route::put('members/children/{child}', [ChildController::class, 'update']);
        Route::delete('members/children/{child}', [ChildController::class, 'destroy']);

        // Members
        Route::apiResource('members', MemberController::class)->only(['index', 'show', 'update']);
        Route::get('members/{member}/card', [MemberController::class, 'card']);
        Route::post('members/{member}/favorite', [FavoriteController::class, 'store']);
        Route::delete('members/{member}/favorite', [FavoriteController::class, 'destroy']);

        // Favorites
        Route::get('favorites', [FavoriteController::class, 'index']);

        // News
        Route::apiResource('news', NewsController::class)->only(['index', 'show']);
        Route::get('news/{news}/comments', [NewsCommentController::class, 'index']);
        Route::post('news/{news}/comments', [NewsCommentController::class, 'store'])
            ->middleware('throttle:news-interactions');
        Route::delete('news/{news}/comments/{comment}', [NewsCommentController::class, 'destroy']);
        Route::post('news/{news}/reactions', [NewsReactionController::class, 'store'])
            ->middleware('throttle:news-interactions');
        Route::delete('news/{news}/reactions', [NewsReactionController::class, 'destroy']);

        // Events
        Route::apiResource('events', EventController::class)->only(['index', 'show']);
        Route::post('events/{event}/rsvp', [EventController::class, 'rsvp']);
        Route::post('events/{event}/gallery', [EventController::class, 'uploadGallery']);
        Route::delete('events/{event}/gallery/{media}', [EventController::class, 'deleteGalleryItem']);

        // Offers
        Route::apiResource('offers', OfferController::class)->only(['index', 'show']);

        // Family Fund
        Route::get('fund', [FundController::class, 'index']);
        Route::get('fund/summary', [FundController::class, 'summary']);
        Route::get('fund/profile', [FundController::class, 'profile']);
        Route::get('fund/initiatives', [FundController::class, 'initiatives']);
        Route::get('fund/support-requests', [FundController::class, 'mySupportRequests']);
        Route::post('fund/support-requests', [FundController::class, 'storeSupportRequest']);
        Route::get('fund/support-requests/{id}', [FundController::class, 'showSupportRequest']);

        // Suggestions
        Route::get('suggestions', [SuggestionController::class, 'index']);
        Route::post('suggestions', [SuggestionController::class, 'store']);

        // Notifications
        Route::get('notifications', [NotificationController::class, 'index']);
        Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::put('notifications/read-all', [NotificationController::class, 'markAllAsRead']);

        // Device registration
        Route::post('devices', [MemberController::class, 'registerDevice']);

        // Global Search
        Route::get('search', [SearchController::class, 'index']);
    });
});
