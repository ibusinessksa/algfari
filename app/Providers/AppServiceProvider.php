<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\News;
use App\Models\Offer;
use App\Models\User;
use App\Observers\EventObserver;
use App\Observers\NewsObserver;
use App\Observers\OfferObserver;
use App\Observers\UserObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        User::observe(UserObserver::class);

        $this->configureRateLimiters();

        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());
    }

    private function configureRateLimiters(): void
    {
        RateLimiter::for('api', fn (Request $r) => Limit::perMinute(60)
            ->by($r->user()?->id ?: $r->ip()));

        // 5 OTP / forgot-password attempts per minute per IP+phone/email
        RateLimiter::for('auth-sensitive', fn (Request $r) => Limit::perMinute(5)
            ->by($r->ip() . '|' . ($r->input('phone_number') ?: $r->input('email') ?: '')));

        // 10 login attempts per minute per IP
        RateLimiter::for('login', fn (Request $r) => Limit::perMinute(10)->by($r->ip()));

        // Mutations on news interactions (prevent spam)
        RateLimiter::for('news-interactions', fn (Request $r) => Limit::perMinute(30)
            ->by($r->user()?->id ?: $r->ip()));
    }
}
