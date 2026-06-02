<?php

namespace Tests\Feature\Api\V1;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfferOrderingTest extends TestCase
{
    use RefreshDatabase;

    public function test_latest_first_reverses_default_ordering(): void
    {
        $user = User::factory()->create();

        $oldest = Offer::factory()->create(['is_active' => true, 'expires_at' => null, 'created_at' => now()->subDays(3)]);
        $middle = Offer::factory()->create(['is_active' => true, 'expires_at' => null, 'created_at' => now()->subDays(2)]);
        $newest = Offer::factory()->create(['is_active' => true, 'expires_at' => null, 'created_at' => now()->subDay()]);

        $default = $this->actingAs($user, 'sanctum')->getJson('/api/v1/offers');
        $default->assertOk();
        $this->assertSame(
            [$oldest->id, $middle->id, $newest->id],
            collect($default->json('data'))->pluck('id')->all(),
            'Default should be oldest first.'
        );

        $latest = $this->actingAs($user, 'sanctum')->getJson('/api/v1/offers?latest_first=1');
        $latest->assertOk();
        $this->assertSame(
            [$newest->id, $middle->id, $oldest->id],
            collect($latest->json('data'))->pluck('id')->all(),
            'latest_first=1 should be newest first.'
        );
    }

    public function test_type_filter_combines_with_latest_first(): void
    {
        $user = User::factory()->create();

        $oldComm = Offer::factory()->create(['type' => 'commercial', 'is_active' => true, 'expires_at' => null, 'created_at' => now()->subDays(2)]);
        $newComm = Offer::factory()->create(['type' => 'commercial', 'is_active' => true, 'expires_at' => null, 'created_at' => now()->subDay()]);
        Offer::factory()->create(['type' => 'normal', 'is_active' => true, 'expires_at' => null]);

        $res = $this->actingAs($user, 'sanctum')->getJson('/api/v1/offers?type=commercial&latest_first=1');
        $res->assertOk();
        $this->assertSame(
            [$newComm->id, $oldComm->id],
            collect($res->json('data'))->pluck('id')->all()
        );
    }
}
