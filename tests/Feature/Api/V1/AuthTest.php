<?php

namespace Tests\Feature\Api\V1;

use App\Enums\OtpPurpose;
use App\Enums\UserStatus;
use App\Models\Country;
use App\Models\JoinRequest;
use App\Models\OtpCode;
use App\Models\Region;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_phone(): void
    {
        $user = User::factory()->create([
            'phone_number' => '0551234567',
            'status' => UserStatus::Active,
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '0551234567',
            'password' => 'password',
        ]);

        $response->assertOk()
            ->assertJsonStructure(['user', 'token']);
    }

    public function test_login_with_device_token_registers_user_device(): void
    {
        $user = User::factory()->create([
            'phone_number' => '0551234567',
            'status' => UserStatus::Active,
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '0551234567',
            'password' => 'password',
            'device_token' => 'fcm-token-abc123xyz',
            'platform' => 'android',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('user_devices', [
            'user_id' => $user->id,
            'device_token' => 'fcm-token-abc123xyz',
            'platform' => 'android',
        ]);
    }

    public function test_login_requires_platform_when_device_token_sent(): void
    {
        User::factory()->create([
            'phone_number' => '0551234567',
            'status' => UserStatus::Active,
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '0551234567',
            'password' => 'password',
            'device_token' => 'fcm-token-only',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['platform']);
    }

    public function test_user_can_login_with_national_id(): void
    {
        $user = User::factory()->create([
            'national_id' => '1234567890',
            'status' => UserStatus::Active,
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '1234567890',
            'password' => 'password',
        ]);

        $response->assertOk()
            ->assertJsonStructure(['user', 'token']);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'phone_number' => '0551234567',
            'status' => UserStatus::Active,
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '0551234567',
            'password' => 'wrong-password',
        ]);

        $response->assertUnauthorized();
    }

    public function test_inactive_user_cannot_login(): void
    {
        $user = User::factory()->pending()->create([
            'phone_number' => '0551234567',
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '0551234567',
            'password' => 'password',
        ]);

        $response->assertForbidden();
    }

    public function test_otp_can_be_sent(): void
    {
        $response = $this->postJson('/api/v1/auth/send-otp', [
            'phone_number' => '0551234567',
            'purpose' => 'register',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('otp_codes', [
            'phone_number' => '0551234567',
            'purpose' => OtpPurpose::Register->value,
        ]);
    }

    public function test_otp_can_be_verified(): void
    {
        $otp = OtpCode::create([
            'phone_number' => '0551234567',
            'code' => '123456',
            'purpose' => OtpPurpose::Register,
            'is_used' => false,
            'expires_at' => now()->addMinutes(5),
        ]);

        $response = $this->postJson('/api/v1/auth/verify-otp', [
            'phone_number' => '0551234567',
            'code' => '123456',
            'purpose' => 'register',
        ]);

        $response->assertOk()
            ->assertJson(['verified' => true]);
    }

    public function test_expired_otp_fails_verification(): void
    {
        OtpCode::create([
            'phone_number' => '0551234567',
            'code' => '123456',
            'purpose' => OtpPurpose::Register,
            'is_used' => false,
            'expires_at' => now()->subMinutes(1),
        ]);

        $response = $this->postJson('/api/v1/auth/verify-otp', [
            'phone_number' => '0551234567',
            'code' => '123456',
            'purpose' => 'register',
        ]);

        $response->assertUnprocessable();
    }

    public function test_join_request_can_be_submitted(): void
    {
        $country = Country::create([
            'name' => ['ar' => 'اختبار', 'en' => 'Testland'],
            'code' => 'TX',
        ]);
        $region = Region::create([
            'country_id' => $country->id,
            'name' => ['ar' => 'منطقة تجريبية', 'en' => 'Test Region'],
        ]);

        $response = $this->postJson('/api/v1/auth/join-request', [
            'full_name' => 'محمد أحمد',
            'phone_number' => '0551234567',
            'password' => 'Secret123',
            'password_confirmation' => 'Secret123',
            'pending_family_name' => 'عائلة المُرشّد',
            'region_id' => $region->id,
        ]);

        $response->assertCreated()
            ->assertJsonStructure(['message', 'join_request'])
            ->assertJsonPath('join_request.pending_family_name', 'عائلة المُرشّد')
            ->assertJsonPath('join_request.region_id', $region->id);

        $joinRequest = JoinRequest::first();
        $this->assertNotNull($joinRequest);
        $this->assertSame('عائلة المُرشّد', $joinRequest->pending_family_name);
        $this->assertSame($region->id, $joinRequest->region_id);
        $this->assertTrue(
            Hash::check('Secret123', $joinRequest->getRawOriginal('password'))
        );
    }

    public function test_reset_password_after_verify_otp_step(): void
    {
        User::factory()->create([
            'phone_number' => '0559876543',
        ]);

        OtpCode::create([
            'phone_number' => '0559876543',
            'code' => '654321',
            'purpose' => OtpPurpose::Reset,
            'is_used' => false,
            'expires_at' => now()->addMinutes(5),
        ]);

        $this->postJson('/api/v1/auth/verify-otp', [
            'phone_number' => '0559876543',
            'code' => '654321',
            'purpose' => 'reset',
        ])->assertOk();

        $response = $this->postJson('/api/v1/auth/reset-password', [
            'phone_number' => '0559876543',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertOk();
        $this->assertTrue(Hash::check('newpassword', User::where('phone_number', '0559876543')->first()->password));
    }

    public function test_reset_password_fails_without_prior_otp_verification(): void
    {
        User::factory()->create([
            'phone_number' => '0559111222',
        ]);

        OtpCode::create([
            'phone_number' => '0559111222',
            'code' => '111111',
            'purpose' => OtpPurpose::Reset,
            'is_used' => false,
            'expires_at' => now()->addMinutes(5),
        ]);

        $response = $this->postJson('/api/v1/auth/reset-password', [
            'phone_number' => '0559111222',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertUnprocessable();
    }

    public function test_send_otp_reset_requires_registered_phone(): void
    {
        $response = $this->postJson('/api/v1/auth/send-otp', [
            'phone_number' => '0550000000',
            'purpose' => 'reset',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['phone_number']);
    }

    public function test_change_password(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/auth/change-password', [
                'current_password' => 'password',
                'password' => 'newpassword123',
                'password_confirmation' => 'newpassword123',
            ]);

        $response->assertOk();
    }

    public function test_change_password_fails_with_wrong_current(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/auth/change-password', [
                'current_password' => 'wrong-password',
                'password' => 'newpassword123',
                'password_confirmation' => 'newpassword123',
            ]);

        $response->assertUnprocessable();
    }

    public function test_logout(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('mobile')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/logout');

        $response->assertOk();
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_login_validation_requires_fields(): void
    {
        $response = $this->postJson('/api/v1/auth/login', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['login', 'password']);
    }
}
