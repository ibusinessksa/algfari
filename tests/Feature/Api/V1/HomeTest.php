<?php

namespace Tests\Feature\Api\V1;

use App\Enums\UserStatus;
use App\Models\Event;
use App\Models\News;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_returns_aggregated_payload(): void
    {
        Notification::fake();
        $user = User::factory()->create(['status' => UserStatus::Active]);

        News::factory()->create([
            'published_at' => now()->subDay(),
            'is_urgent' => true,
        ]);

        Offer::factory()->create([
            'offered_by' => $user->id,
            'is_active' => true,
            'is_featured' => true,
            'expires_at' => null,
        ]);

        Event::factory()->create([
            'created_by' => $user->id,
            'is_active' => true,
            'event_date' => now()->addDays(3),
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/home');

        $response->assertOk()
            ->assertJsonStructure([
                'stats' => ['members', 'families', 'events', 'offers'],
                'breaking_news',
                'featured_offers',
                'upcoming_events',
            ]);

        $this->assertCount(1, $response->json('breaking_news'));
        $this->assertCount(1, $response->json('featured_offers'));
        $this->assertCount(1, $response->json('upcoming_events'));
    }

    public function test_home_requires_authentication(): void
    {
        $this->getJson('/api/v1/home')->assertUnauthorized();
    }
}
