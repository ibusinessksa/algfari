<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class HealthAndRateLimitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
        RateLimiter::clear('login|127.0.0.1');
    }

    public function test_health_endpoint_is_public(): void
    {
        $this->getJson('/api/v1/health')
            ->assertOk()
            ->assertJsonStructure(['status', 'time']);
    }

    public function test_login_endpoint_is_throttled(): void
    {
        User::factory()->create(['phone_number' => '0501111111']);

        // 10 hits allowed per minute on the login limiter
        for ($i = 0; $i < 10; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'login' => '0501111111',
                'password' => 'wrong-password',
            ]);
        }

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '0501111111',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(429);
    }
}
