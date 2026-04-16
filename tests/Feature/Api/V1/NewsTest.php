<?php

namespace Tests\Feature\Api\V1;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_published_news(): void
    {
        News::factory()->count(3)->create([
            'published_at' => now(),
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/news');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_unpublished_news_are_excluded(): void
    {
        News::factory()->create([
            'published_at' => null,
        ]);
        News::factory()->create([
            'published_at' => now(),
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/news');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_can_show_single_news(): void
    {
        $news = News::factory()->create([
            'published_at' => now(),
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/v1/news/{$news->id}");

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_urgent_news_appear_first(): void
    {
        News::factory()->create([
            'is_urgent' => false,
            'published_at' => now()->subDay(),
        ]);
        News::factory()->urgent()->create([
            'published_at' => now()->subDays(2),
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/news');

        $response->assertOk();
        $data = $response->json('data');
        if (count($data) >= 2) {
            $this->assertTrue($data[0]['is_urgent'] ?? false);
        }
    }

    public function test_unauthenticated_cannot_access_news(): void
    {
        $response = $this->getJson('/api/v1/news');

        $response->assertUnauthorized();
    }
}
