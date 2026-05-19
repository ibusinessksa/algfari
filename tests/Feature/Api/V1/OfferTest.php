<?php

namespace Tests\Feature\Api\V1;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
        $this->user = User::factory()->create();
    }

    public function test_can_list_active_offers(): void
    {
        $offeredBy = User::factory()->create();
        Offer::factory()->count(3)->create([
            'offered_by' => $offeredBy->id,
            'is_active' => true,
            'expires_at' => null,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/offers');

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_inactive_offers_are_excluded(): void
    {
        $offeredBy = User::factory()->create();
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'is_active' => false,
        ]);
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'is_active' => true,
            'expires_at' => null,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/offers');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_expired_offers_are_excluded(): void
    {
        $offeredBy = User::factory()->create();
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'is_active' => true,
            'expires_at' => now()->subDay(),
        ]);
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'is_active' => true,
            'expires_at' => now()->addDays(10),
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/offers');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_can_filter_offers_by_category(): void
    {
        $offeredBy = User::factory()->create();
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'category' => 'restaurants',
            'is_active' => true,
            'expires_at' => null,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/offers?category=restaurants');

        $response->assertOk();
    }

    public function test_can_show_single_offer(): void
    {
        $offeredBy = User::factory()->create();
        $offer = Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/v1/offers/{$offer->id}");

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_unauthenticated_cannot_access_offers(): void
    {
        $response = $this->getJson('/api/v1/offers');

        $response->assertUnauthorized();
    }

    public function test_can_filter_by_partner_type(): void
    {
        $offeredBy = User::factory()->create();
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'partner_type' => 'external',
            'is_active' => true,
            'expires_at' => null,
        ]);
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'partner_type' => 'family',
            'is_active' => true,
            'expires_at' => null,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/offers?partner_type=external');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_can_filter_featured_offers(): void
    {
        $offeredBy = User::factory()->create();
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'is_featured' => true,
            'is_active' => true,
            'expires_at' => null,
        ]);
        Offer::factory()->create([
            'offered_by' => $offeredBy->id,
            'is_featured' => false,
            'is_active' => true,
            'expires_at' => null,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/offers?featured=1');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }
}
