<?php

namespace Tests\Feature;

use App\Enums\JoinRequestStatus;
use App\Models\Country;
use App\Models\JoinRequest;
use App\Models\Region;
use App\Models\User;
use App\Services\JoinRequestService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class JoinRequestServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_approve_join_request_copies_region_id_to_user(): void
    {
        Notification::fake();

        $country = Country::create([
            'name' => ['ar' => 'اختبار', 'en' => 'Testland'],
            'code' => 'TX',
        ]);
        $region = Region::create([
            'country_id' => $country->id,
            'name' => ['ar' => 'منطقة', 'en' => 'Region'],
        ]);

        $reviewer = User::factory()->admin()->create();

        $joinRequest = JoinRequest::create([
            'full_name' => 'مستخدم جديد',
            'phone_number' => '0551111222',
            'national_id' => null,
            'email' => null,
            'password' => 'secret123',
            'region_id' => $region->id,
            'status' => JoinRequestStatus::Pending,
        ]);

        $user = app(JoinRequestService::class)->approve($joinRequest, (string) $reviewer->id);

        $this->assertSame($region->id, $user->region_id);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'region_id' => $region->id,
        ]);
        $this->assertSame(JoinRequestStatus::Approved, $joinRequest->fresh()->status);
    }
}
