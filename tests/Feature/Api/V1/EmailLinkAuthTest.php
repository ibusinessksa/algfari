<?php

namespace Tests\Feature\Api\V1;

use App\Mail\EmailVerificationLinkMail;
use App\Mail\PasswordResetLinkMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailLinkAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_verification_link(): void
    {
        Mail::fake();
        $user = User::factory()->create([
            'email' => 'foo@example.com',
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/auth/send-email-verification-link');

        $response->assertOk();
        Mail::assertSent(EmailVerificationLinkMail::class);
    }

    public function test_valid_signed_link_verifies_email(): void
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        $url = URL::temporarySignedRoute(
            'api.email.verify-link',
            now()->addHours(24),
            ['user' => $user->id]
        );

        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);

        $this->getJson($path . '?' . $query)->assertOk();
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function test_unsigned_link_is_rejected(): void
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        $this->getJson('/api/v1/auth/email/verify-link/' . $user->id)
            ->assertStatus(422);

        $this->assertNull($user->fresh()->email_verified_at);
    }

    public function test_forgot_password_email_sends_link(): void
    {
        Mail::fake();
        User::factory()->create(['email' => 'reset.me@example.com']);

        $response = $this->postJson('/api/v1/auth/forgot-password/email', [
            'email' => 'reset.me@example.com',
        ]);

        $response->assertOk();
        Mail::assertSent(PasswordResetLinkMail::class);
    }

    public function test_password_reset_via_signed_link(): void
    {
        $user = User::factory()->create();
        $url = URL::temporarySignedRoute(
            'api.password.reset-link',
            now()->addHours(2),
            ['user' => $user->id]
        );
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);

        $response = $this->postJson($path . '?' . $query, [
            'password' => 'Strong1Pass',
            'password_confirmation' => 'Strong1Pass',
        ]);

        $response->assertOk();
        $this->assertTrue(Hash::check('Strong1Pass', $user->fresh()->password));
    }
}
