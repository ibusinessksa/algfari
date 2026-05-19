<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\EventResource;
use App\Http\Resources\Api\V1\NewsResource;
use App\Http\Resources\Api\V1\OfferResource;
use App\Models\Event;
use App\Models\Family;
use App\Models\News;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * @group Home
 *
 * Aggregated data for the mobile app home screen.
 */
class HomeController extends Controller
{
    /**
     * Home Screen Payload
     *
     * Returns stats, breaking news, featured offers and upcoming events in one call.
     *
     * @response 200 scenario="success" {
     *   "stats": {"members": 0, "families": 0, "events": 0, "offers": 0, "visitors": 0},
     *   "breaking_news": [],
     *   "featured_offers": [],
     *   "upcoming_events": []
     * }
     */
    public function index(): JsonResponse
    {
        $stats = Cache::remember('home_stats', now()->addSeconds(60), fn () => [
            'members' => User::query()->where('status', UserStatus::Active)->count(),
            'families' => Family::query()->count(),
            'events' => Event::query()->where('is_active', true)->count(),
            'offers' => Offer::query()->where('is_active', true)->count(),
            'visitors' => (int) (DB::table('visitor_counters')->where('key', 'app')->value('count') ?? 0),
        ]);

        $breakingNews = News::query()
            ->with('media')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('is_urgent')
            ->latest('published_at')
            ->limit(5)
            ->get();

        $featuredOffers = Offer::query()
            ->with(['offeredBy', 'media', 'region'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->where(fn ($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()))
            ->latest()
            ->limit(5)
            ->get();

        $upcomingEvents = Event::query()
            ->with(['creator', 'media'])
            ->withCount('attendees')
            ->where('is_active', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->limit(3)
            ->get();

        return response()->json([
            'stats' => $stats,
            'breaking_news' => NewsResource::collection($breakingNews),
            'featured_offers' => OfferResource::collection($featuredOffers),
            'upcoming_events' => EventResource::collection($upcomingEvents),
        ]);
    }
}
