<?php

namespace Tests\Feature\Api\V1;

use App\Enums\UserRole;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
        $this->user = User::factory()->create();
    }

    public function test_can_list_active_events(): void
    {
        $creator = User::factory()->create();
        Event::factory()->count(3)->create([
            'created_by' => $creator->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/events');

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_inactive_events_are_excluded(): void
    {
        $creator = User::factory()->create();
        Event::factory()->create([
            'created_by' => $creator->id,
            'is_active' => false,
        ]);
        Event::factory()->create([
            'created_by' => $creator->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/events');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_can_filter_upcoming_events(): void
    {
        $creator = User::factory()->create();
        Event::factory()->create([
            'created_by' => $creator->id,
            'event_date' => now()->addDays(5),
            'is_active' => true,
        ]);
        Event::factory()->create([
            'created_by' => $creator->id,
            'event_date' => now()->subDays(5),
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/events?upcoming=1');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_can_filter_events_by_type(): void
    {
        $creator = User::factory()->create();
        Event::factory()->create([
            'created_by' => $creator->id,
            'event_type' => 'wedding',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/events?event_type=wedding');

        $response->assertOk();
    }

    public function test_can_show_single_event(): void
    {
        $creator = User::factory()->create();
        $event = Event::factory()->create([
            'created_by' => $creator->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/v1/events/{$event->id}");

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_can_rsvp_to_event(): void
    {
        $creator = User::factory()->create();
        $event = Event::factory()->create([
            'created_by' => $creator->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson("/api/v1/events/{$event->id}/rsvp", [
                'status' => 'going',
            ]);

        $response->assertOk();
        $this->assertDatabaseHas('event_attendees', [
            'event_id' => $event->id,
            'user_id' => $this->user->id,
            'rsvp_status' => 'going',
        ]);
    }

    public function test_can_update_rsvp(): void
    {
        $creator = User::factory()->create();
        $event = Event::factory()->create([
            'created_by' => $creator->id,
            'is_active' => true,
        ]);

        // First RSVP
        $this->actingAs($this->user, 'sanctum')
            ->postJson("/api/v1/events/{$event->id}/rsvp", ['status' => 'going']);

        // Update RSVP
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson("/api/v1/events/{$event->id}/rsvp", ['status' => 'declined']);

        $response->assertOk();
        $this->assertDatabaseHas('event_attendees', [
            'event_id' => $event->id,
            'user_id' => $this->user->id,
            'rsvp_status' => 'declined',
        ]);
    }

    public function test_unauthenticated_cannot_access_events(): void
    {
        $response = $this->getJson('/api/v1/events');

        $response->assertUnauthorized();
    }

    public function test_event_creator_can_upload_gallery_images(): void
    {
        $event = Event::factory()->create([
            'created_by' => $this->user->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson("/api/v1/events/{$event->id}/gallery", [
                'images' => [
                    UploadedFile::fake()->image('a.jpg'),
                    UploadedFile::fake()->image('b.jpg'),
                ],
            ]);

        $response->assertCreated()
            ->assertJsonStructure(['message', 'gallery']);
        $this->assertCount(2, $response->json('gallery'));
    }

    public function test_non_creator_non_admin_cannot_upload_gallery(): void
    {
        $creator = User::factory()->create();
        $event = Event::factory()->create([
            'created_by' => $creator->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson("/api/v1/events/{$event->id}/gallery", [
                'images' => [UploadedFile::fake()->image('a.jpg')],
            ]);

        $response->assertForbidden();
    }

    public function test_admin_can_upload_gallery_for_any_event(): void
    {
        $creator = User::factory()->create();
        $admin = User::factory()->create(['role' => UserRole::Admin]);
        $event = Event::factory()->create([
            'created_by' => $creator->id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin, 'sanctum')
            ->postJson("/api/v1/events/{$event->id}/gallery", [
                'images' => [UploadedFile::fake()->image('a.jpg')],
            ]);

        $response->assertCreated();
    }

}
