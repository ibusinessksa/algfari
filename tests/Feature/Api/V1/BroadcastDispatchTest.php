<?php

namespace Tests\Feature\Api\V1;

use App\Enums\UserStatus;
use App\Jobs\DispatchBroadcast;
use App\Mail\BroadcastMail;
use App\Models\Broadcast;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class BroadcastDispatchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_dispatch_sends_email_to_all_active_users(): void
    {
        Mail::fake();

        User::factory()->create([
            'status' => UserStatus::Active,
            'email' => 'a@example.com',
        ]);
        User::factory()->create([
            'status' => UserStatus::Active,
            'email' => 'b@example.com',
        ]);
        User::factory()->create([
            'status' => UserStatus::Pending,
            'email' => 'pending@example.com',
        ]);

        $broadcast = Broadcast::create([
            'title' => 'إعلان مهم',
            'body' => 'محتوى الإعلان',
            'audience_type' => 'all',
            'channels' => ['email'],
        ]);

        (new DispatchBroadcast($broadcast->id))->handle(app(\App\Services\SmsService::class));

        Mail::assertQueued(BroadcastMail::class, 2);
        $this->assertNotNull($broadcast->fresh()->sent_at);
        $this->assertSame(2, $broadcast->fresh()->recipients_count);
    }

    public function test_dispatch_respects_audience_role_filter(): void
    {
        Mail::fake();
        User::factory()->create(['status' => UserStatus::Active, 'role' => 'admin']);
        User::factory()->create(['status' => UserStatus::Active, 'role' => 'member']);
        User::factory()->create(['status' => UserStatus::Active, 'role' => 'member']);

        $b = Broadcast::create([
            'title' => 'Admins only',
            'body' => 'هام للمديرين',
            'audience_type' => 'role',
            'audience_filter' => ['role' => 'admin'],
            'channels' => ['email'],
        ]);

        (new DispatchBroadcast($b->id))->handle(app(\App\Services\SmsService::class));

        $this->assertSame(1, $b->fresh()->recipients_count);
    }
}
