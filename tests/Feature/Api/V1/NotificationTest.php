<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    private function createNotification(bool $read = false): DatabaseNotification
    {
        return DatabaseNotification::create([
            'id' => Str::uuid()->toString(),
            'type' => 'App\\Notifications\\NewNewsPublished',
            'notifiable_type' => User::class,
            'notifiable_id' => $this->user->id,
            'data' => [
                'title' => ['ar' => 'عنوان الإشعار', 'en' => 'Notification title'],
                'body' => ['ar' => 'محتوى الإشعار', 'en' => 'Notification body'],
                'type' => 'news',
            ],
            'read_at' => $read ? now() : null,
        ]);
    }

    public function test_can_list_notifications(): void
    {
        $this->createNotification();
        $this->createNotification();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/notifications');

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_can_mark_notification_as_read(): void
    {
        $notification = $this->createNotification();

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson("/api/v1/notifications/{$notification->id}/read");

        $response->assertOk();
        $this->assertNotNull($notification->fresh()->read_at);
    }

    public function test_mark_nonexistent_notification_returns_404(): void
    {
        $fakeId = Str::uuid()->toString();

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson("/api/v1/notifications/{$fakeId}/read");

        $response->assertNotFound();
    }

    public function test_can_mark_all_notifications_as_read(): void
    {
        $this->createNotification();
        $this->createNotification();

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson('/api/v1/notifications/read-all');

        $response->assertOk();

        $unread = $this->user->unreadNotifications()->count();
        $this->assertEquals(0, $unread);
    }

    public function test_unauthenticated_cannot_access_notifications(): void
    {
        $response = $this->getJson('/api/v1/notifications');

        $response->assertUnauthorized();
    }
}
