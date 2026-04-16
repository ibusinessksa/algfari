<?php

use App\Http\Controllers\FilamentLocaleController;
use App\Models\Event;
use App\Models\Family;
use App\Models\News;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::post('/admin/set-locale', [FilamentLocaleController::class, 'update'])
    ->middleware('web')
    ->name('filament.admin.set-locale');

Route::get('/', function () {
    $stats = [
        'members' => rescue(fn () => User::query()->count(), 0, false),
        'families' => rescue(fn () => Family::query()->count(), 0, false),
        'events' => rescue(fn () => Event::query()->where('is_active', true)->count(), 0, false),
        'offers' => rescue(fn () => Offer::query()->where('is_active', true)->count(), 0, false),
    ];

    $latestNews = rescue(
        fn () => News::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->limit(3)
            ->get(),
        collect(),
        false,
    );

    return view('welcome', compact('stats', 'latestNews'));
})->name('home');
