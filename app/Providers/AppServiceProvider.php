<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\News;
use App\Models\Offer;
use App\Observers\EventObserver;
use App\Observers\NewsObserver;
use App\Observers\OfferObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        News::observe(NewsObserver::class);
        Event::observe(EventObserver::class);
        Offer::observe(OfferObserver::class);
    }
}
