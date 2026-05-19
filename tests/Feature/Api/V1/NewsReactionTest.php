<?php

namespace Tests\Feature\Api\V1;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NewsReactionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_user_can_react_once_and_updating_replaces_reaction(): void
    {
        $user = User::factory()->create();
        $news = News::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/news/{$news->id}/reactions", ['type' => 'like'])
            ->assertOk();

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/news/{$news->id}/reactions", ['type' => 'love'])
            ->assertOk();

        $this->assertDatabaseCount('news_reactions', 1);
        $this->assertDatabaseHas('news_reactions', [
            'news_id' => $news->id,
            'user_id' => $user->id,
            'type' => 'love',
        ]);
    }

    public function test_user_can_remove_their_reaction(): void
    {
        $user = User::factory()->create();
        $news = News::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/news/{$news->id}/reactions", ['type' => 'like'])
            ->assertOk();

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/news/{$news->id}/reactions")
            ->assertOk();

        $this->assertDatabaseCount('news_reactions', 0);
    }

    public function test_invalid_reaction_type_is_rejected(): void
    {
        $user = User::factory()->create();
        $news = News::factory()->create();

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/news/{$news->id}/reactions", ['type' => 'fire'])
            ->assertUnprocessable();
    }
}
