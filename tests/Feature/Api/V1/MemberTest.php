<?php

namespace Tests\Feature\Api\V1;

use App\Enums\FamilyRequestStatus;
use App\Enums\UserStatus;
use App\Models\Family;
use App\Models\MemberDaughter;
use App\Models\MemberSon;
use App\Models\User;
use App\Notifications\AdminFamilyRequestSubmitted;
use App\Support\FamilyNameNormalizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_members(): void
    {
        User::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/members');

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_only_active_members_are_listed(): void
    {
        User::factory()->count(2)->create(['status' => UserStatus::Active]);
        User::factory()->pending()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/members');

        $response->assertOk();

        // All returned members should be active (pending ones excluded)
        $data = $response->json('data');
        foreach ($data as $member) {
            $this->assertEquals('active', $member['status'] ?? $member['data']['status'] ?? 'active');
        }
    }

    public function test_can_search_members(): void
    {
        User::factory()->create(['full_name' => 'أحمد محمد']);
        User::factory()->create(['full_name' => 'خالد سعد']);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/members?search=أحمد');

        $response->assertOk();
    }

    public function test_can_filter_members_by_family_name(): void
    {
        $familyA = Family::factory()->create(['name' => 'الجربوع']);
        $familyB = Family::factory()->create(['name' => 'بني تميم']);
        User::factory()->create(['family_id' => $familyA->id]);
        User::factory()->create(['family_id' => $familyB->id]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/members?family='.rawurlencode('الجربوع'));

        $response->assertOk();
        $ids = collect($response->json('data'))->pluck('id');
        $this->assertTrue($ids->contains(fn ($id) => User::where('family_id', $familyA->id)->whereKey($id)->exists()));
    }

    public function test_can_show_member(): void
    {
        $member = User::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/v1/members/{$member->id}");

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_show_member_includes_family_sons_and_daughters(): void
    {
        $family = Family::factory()->create([
            'name' => 'الجربوع',
            'origin' => 'أهل الرس',
        ]);

        $linkedChild = User::factory()->create(['full_name' => 'عضو مسجل']);

        $member = User::factory()->create([
            'family_id' => $family->id,
            'workplace' => 'غير محدد',
            'current_job' => 'غير محدد',
        ]);

        MemberSon::factory()->create([
            'user_id' => $member->id,
            'name' => 'عبدالعزيز',
            'linked_user_id' => null,
            'sort_order' => 0,
        ]);
        MemberSon::factory()->create([
            'user_id' => $member->id,
            'name' => null,
            'linked_user_id' => $linkedChild->id,
            'sort_order' => 1,
        ]);
        MemberDaughter::factory()->create(['user_id' => $member->id, 'name' => 'سعداء']);
        MemberDaughter::factory()->create(['user_id' => $member->id, 'name' => 'لطيفة']);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/v1/members/{$member->id}");

        $response->assertOk()
            ->assertJsonPath('data.family.id', $family->id)
            ->assertJsonPath('data.family.name', 'الجربوع')
            ->assertJsonPath('data.family.origin', 'أهل الرس')
            ->assertJsonPath('data.id', $member->id)
            ->assertJsonPath('data.sons.0.name', 'عبدالعزيز')
            ->assertJsonPath('data.sons.1.name', 'عضو مسجل')
            ->assertJsonPath('data.sons.1.linked_user_id', $linkedChild->id)
            ->assertJsonPath('data.sons.1.linked_user.full_name', 'عضو مسجل')
            ->assertJsonPath('data.daughters.0.name', 'سعداء')
            ->assertJsonPath('data.daughters.1.name', 'لطيفة');
    }

    public function test_can_update_own_profile(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson("/api/v1/members/{$this->user->id}", [
                'full_name' => 'اسم جديد',
                'city' => 'الرياض',
            ]);

        $response->assertOk();
        $this->assertEquals('اسم جديد', $this->user->fresh()->full_name);
    }

    public function test_pending_family_name_does_not_auto_link_even_when_family_exists(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();
        Family::factory()->create(['name' => 'الجربوع', 'origin' => 'أهل الرس']);
        $member = User::factory()->create(['family_id' => null]);

        $response = $this->actingAs($member, 'sanctum')
            ->putJson("/api/v1/members/{$member->id}", [
                'pending_family_name' => 'الجربوع',
            ]);

        $response->assertOk();
        $member->refresh();
        $this->assertNull($member->family_id);
        $this->assertEquals('الجربوع', $member->pending_family_name);

        $this->assertDatabaseHas('family_requests', [
            'user_id' => $member->id,
            'name' => FamilyNameNormalizer::normalize('الجربوع'),
            'status' => FamilyRequestStatus::Pending->value,
        ]);

        Notification::assertSentTo($admin, AdminFamilyRequestSubmitted::class);
    }

    public function test_update_member_pending_family_name_creates_request_and_notifies_admins(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();
        $member = User::factory()->create(['family_id' => null]);

        $response = $this->actingAs($member, 'sanctum')
            ->putJson("/api/v1/members/{$member->id}", [
                'pending_family_name' => 'عائلة غير مسجّلة',
            ]);

        $response->assertOk();
        Notification::assertSentTo($admin, AdminFamilyRequestSubmitted::class);

        $member->refresh();
        $this->assertNull($member->family_id);
        $this->assertEquals('عائلة غير مسجّلة', $member->pending_family_name);

        $this->assertDatabaseHas('family_requests', [
            'user_id' => $member->id,
            'name' => FamilyNameNormalizer::normalize('عائلة غير مسجّلة'),
            'status' => FamilyRequestStatus::Pending->value,
        ]);
    }

    public function test_member_cannot_set_family_id_via_api(): void
    {
        $family = Family::factory()->create(['name' => 'عائلة أ']);
        $member = User::factory()->create(['family_id' => null]);

        $response = $this->actingAs($member, 'sanctum')
            ->putJson("/api/v1/members/{$member->id}", [
                'family_id' => $family->id,
            ]);

        $response->assertStatus(422);
        $member->refresh();
        $this->assertNull($member->family_id);
    }

    public function test_member_can_withdraw_pending_family_name(): void
    {
        Notification::fake();

        User::factory()->admin()->create();
        $member = User::factory()->create(['family_id' => null]);

        $this->actingAs($member, 'sanctum')
            ->putJson("/api/v1/members/{$member->id}", [
                'pending_family_name' => 'طلب مؤقت',
            ])
            ->assertOk();

        $this->actingAs($member, 'sanctum')
            ->putJson("/api/v1/members/{$member->id}", [
                'pending_family_name' => '',
            ])
            ->assertOk();

        $member->refresh();
        $this->assertNull($member->pending_family_name);
        $this->assertDatabaseMissing('family_requests', [
            'user_id' => $member->id,
            'status' => FamilyRequestStatus::Pending->value,
        ]);
    }

    public function test_can_view_member_card(): void
    {
        $member = User::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/v1/members/{$member->id}/card");

        $response->assertOk()
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'full_name',
                         'family',
                         'workplace',
                         'current_job',
                         'city',
                         'bio',
                         'sons',
                         'daughters',
                     ],
                 ]);
    }

    public function test_can_register_device(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/devices', [
                'device_token' => 'fcm-token-abc123',
                'platform' => 'android',
            ]);

        $response->assertOk();
        $this->assertDatabaseHas('user_devices', [
            'user_id' => $this->user->id,
            'device_token' => 'fcm-token-abc123',
            'platform' => 'android',
        ]);
    }

    public function test_unauthenticated_cannot_list_members(): void
    {
        $response = $this->getJson('/api/v1/members');

        $response->assertUnauthorized();
    }

    public function test_can_filter_featured_members(): void
    {
        User::factory()->featured()->create();
        User::factory()->create(['is_featured' => false]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/members?is_featured=1');

        $response->assertOk();
    }
}
