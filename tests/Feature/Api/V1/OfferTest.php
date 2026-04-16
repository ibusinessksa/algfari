<?php

namespace Tests\Feature\Api\V1;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
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
            'category' => 'commercial',
            'is_active' => true,
            'expires_at' => null,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/offers?category=commercial');

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
}
