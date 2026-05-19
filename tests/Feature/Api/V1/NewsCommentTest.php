<?php

namespace Tests\Feature\Api\V1;

use App\Enums\NewsCommentStatus;
use App\Enums\UserRole;
use App\Models\News;
use App\Models\NewsComment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NewsCommentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_user_can_post_and_list_approved_comments(): void
    {
        $user = User::factory()->create();
        $news = News::factory()->create(['published_at' => now()]);

        $this->actingAs($user, 'sanctum')
            ->postJson("/api/v1/news/{$news->id}/comments", [
                'content' => 'تعليق جميل على الخبر.',
            ])->assertCreated();

        // Add a rejected comment to ensure filtering
        NewsComment::create([
            'news_id' => $news->id,
            'user_id' => $user->id,
            'content' => 'مرفوض',
            'status' => NewsCommentStatus::Rejected,
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/news/{$news->id}/comments");

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_user_can_delete_own_comment(): void
    {
        $user = User::factory()->create();
        $news = News::factory()->create();
        $comment = NewsComment::create([
            'news_id' => $news->id,
            'user_id' => $user->id,
            'content' => 'مالي',
        ]);

        $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/news/{$news->id}/comments/{$comment->id}")
            ->assertOk();

        $this->assertSoftDeleted($comment);
    }

    public function test_other_users_cannot_delete_someone_elses_comment(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $news = News::factory()->create();
        $comment = NewsComment::create([
            'news_id' => $news->id,
            'user_id' => $owner->id,
            'content' => 'ملك خالد',
        ]);

        $this->actingAs($other, 'sanctum')
            ->deleteJson("/api/v1/news/{$news->id}/comments/{$comment->id}")
            ->assertForbidden();
    }

    public function test_admin_can_delete_any_comment(): void
    {
        $owner = User::factory()->create();
        $admin = User::factory()->create(['role' => UserRole::Admin]);
        $news = News::factory()->create();
        $comment = NewsComment::create([
            'news_id' => $news->id,
            'user_id' => $owner->id,
            'content' => 'سيُحذف',
        ]);

        $this->actingAs($admin, 'sanctum')
            ->deleteJson("/api/v1/news/{$news->id}/comments/{$comment->id}")
            ->assertOk();
    }
}
