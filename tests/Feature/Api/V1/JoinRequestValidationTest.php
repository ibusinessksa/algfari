<?php

namespace Tests\Feature\Api\V1;

use App\Enums\JoinRequestStatus;
use App\Models\Country;
use App\Models\JoinRequest;
use App\Models\Region;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JoinRequestValidationTest extends TestCase
{
    use RefreshDatabase;

    private function regionPayload(): array
    {
        $country = Country::create([
            'name' => ['ar' => 'اختبار', 'en' => 'Testland'],
            'code' => 'TX',
        ]);
        $region = Region::create([
            'country_id' => $country->id,
            'name' => ['ar' => 'منطقة', 'en' => 'Region'],
        ]);

        return ['region' => $region, 'region_id' => $region->id];
    }

    private function validPayload(array $overrides = []): array
    {
        $r = $this->regionPayload();

        return array_merge([
            'full_name' => 'محمد أحمد',
            'phone_number' => '0551234567',
            'password' => 'Secret123',
            'password_confirmation' => 'Secret123',
            'region_id' => $r['region_id'],
        ], $overrides);
    }

    public function test_join_request_accepts_plus_966_phone_and_normalizes(): void
    {
        $payload = $this->validPayload([
            'phone_number' => '+966551234567',
        ]);

        $response = $this->postJson('/api/v1/auth/join-request', $payload);

        $response->assertCreated();
        $this->assertSame('0551234567', JoinRequest::first()->phone_number);
    }

    public function test_join_request_rejects_invalid_saudi_mobile(): void
    {
        $response = $this->postJson('/api/v1/auth/join-request', $this->validPayload([
            'phone_number' => '0212345678',
        ]));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['phone_number']);
    }

    public function test_join_request_rejects_when_phone_already_registered(): void
    {
        User::factory()->create(['phone_number' => '0551234567']);

        $response = $this->postJson('/api/v1/auth/join-request', $this->validPayload());

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['phone_number']);
    }

    public function test_join_request_rejects_duplicate_pending_phone(): void
    {
        $payload = $this->validPayload();
        JoinRequest::create([
            'full_name' => 'Existing',
            'phone_number' => '0551234567',
            'password' => 'Secret123',
            'status' => JoinRequestStatus::Pending,
        ]);

        $response = $this->postJson('/api/v1/auth/join-request', $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['phone_number']);
    }

    public function test_join_request_allows_same_phone_after_previous_request_rejected(): void
    {
        $payload = $this->validPayload();
        JoinRequest::create([
            'full_name' => 'Old',
            'phone_number' => '0551234567',
            'password' => 'Secret123',
            'status' => JoinRequestStatus::Rejected,
        ]);

        $response = $this->postJson('/api/v1/auth/join-request', $payload);

        $response->assertCreated();
    }

    public function test_join_request_requires_region_id(): void
    {
        $payload = $this->validPayload();
        unset($payload['region_id']);

        $response = $this->postJson('/api/v1/auth/join-request', $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['region_id']);
    }

    public function test_join_request_rejects_weak_password(): void
    {
        $response = $this->postJson('/api/v1/auth/join-request', $this->validPayload([
            'password' => 'short1',
            'password_confirmation' => 'short1',
        ]));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function test_join_request_rejects_password_without_numbers(): void
    {
        $response = $this->postJson('/api/v1/auth/join-request', $this->validPayload([
            'password' => 'OnlyLetters',
            'password_confirmation' => 'OnlyLetters',
        ]));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function test_join_request_rejects_invalid_national_id_format(): void
    {
        $response = $this->postJson('/api/v1/auth/join-request', $this->validPayload([
            'national_id' => '3123456789',
        ]));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['national_id']);
    }

    public function test_join_request_rejects_national_id_already_used_by_user(): void
    {
        User::factory()->create(['national_id' => '1234567890']);

        $response = $this->postJson('/api/v1/auth/join-request', $this->validPayload([
            'national_id' => '1234567890',
        ]));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['national_id']);
    }

    public function test_join_request_rejects_invalid_full_name_characters(): void
    {
        $response = $this->postJson('/api/v1/auth/join-request', $this->validPayload([
            'full_name' => '###@@@',
        ]));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['full_name']);
    }
}
