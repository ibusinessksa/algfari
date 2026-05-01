<?php

namespace Tests\Feature\Api\V1;

use App\Models\Event;
use App\Models\FamilyFundTransaction;
use App\Models\News;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_search_across_all_features_with_unified_shape(): void
    {
        $authUser = User::factory()->createOne();
        $owner = User::factory()->createOne(['full_name' => 'صاحب زواج']);

        Event::factory()->create([
            'created_by' => $owner->id,
            'is_active' => true,
            'title' => ['ar' => 'زواج العائلة', 'en' => 'Family wedding'],
            'description' => ['ar' => 'تفاصيل المناسبة', 'en' => 'Details'],
        ]);

        Offer::factory()->create([
            'offered_by' => $owner->id,
            'is_active' => true,
            'expires_at' => now()->addDays(10),
            'title' => ['ar' => 'خدمة زواج', 'en' => 'Wedding service'],
            'description' => ['ar' => 'عرض خاص', 'en' => 'Special offer'],
        ]);

        News::factory()->create([
            'published_at' => now(),
            'title' => ['ar' => 'خبر زواج', 'en' => 'Wedding news'],
            'content' => ['ar' => 'محتوى الخبر', 'en' => 'News content'],
        ]);

        FamilyFundTransaction::factory()->approved()->create([
            'contributor_id' => $owner->id,
            'description' => ['ar' => 'دعم مناسبة زواج', 'en' => 'Support wedding event'],
        ]);

        $response = $this->actingAs($authUser, 'sanctum')
            ->getJson('/api/v1/search?q=زواج');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['type', 'navigation_id', 'title' => ['ar', 'en']],
                ],
            ]);

        $types = collect($response->json('data'))->pluck('type')->all();

        $this->assertContains('event', $types);
        $this->assertContains('offer', $types);
        $this->assertContains('new', $types);
        $this->assertContains('family_fund', $types);
        $this->assertContains('member', $types);
    }

    public function test_search_requires_query_parameter(): void
    {
        $user = User::factory()->createOne();

        $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/search')
            ->assertStatus(422);
    }
}
