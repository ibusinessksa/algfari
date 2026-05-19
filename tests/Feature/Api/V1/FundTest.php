<?php

namespace Tests\Feature\Api\V1;

use App\Models\FamilyFundTransaction;
use App\Models\FundInitiative;
use App\Models\FundProfile;
use App\Models\SupportRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FundTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_approved_transactions(): void
    {
        $contributor = User::factory()->create();
        FamilyFundTransaction::factory()->approved()->count(3)->create([
            'contributor_id' => $contributor->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/fund');

        $response->assertOk()
                 ->assertJsonStructure(['data']);
    }

    public function test_pending_transactions_are_excluded(): void
    {
        $contributor = User::factory()->create();
        FamilyFundTransaction::factory()->create([
            'contributor_id' => $contributor->id,
            'status' => 'pending',
        ]);
        FamilyFundTransaction::factory()->approved()->create([
            'contributor_id' => $contributor->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/fund');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_can_filter_by_transaction_type(): void
    {
        $contributor = User::factory()->create();
        FamilyFundTransaction::factory()->approved()->create([
            'contributor_id' => $contributor->id,
            'transaction_type' => 'donation',
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/fund?type=donation');

        $response->assertOk();
    }

    public function test_can_get_fund_summary(): void
    {
        $contributor = User::factory()->create();

        FamilyFundTransaction::factory()->approved()->create([
            'contributor_id' => $contributor->id,
            'transaction_type' => 'donation',
            'amount' => 1000.00,
        ]);
        FamilyFundTransaction::factory()->approved()->create([
            'contributor_id' => $contributor->id,
            'transaction_type' => 'expense',
            'amount' => 300.00,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/fund/summary');

        $response->assertOk()
                 ->assertJsonStructure([
                     'total_donations',
                     'total_expenses',
                     'balance',
                     'transactions_count',
                 ]);

        $this->assertEquals(1000, $response->json('total_donations'));
        $this->assertEquals(300, $response->json('total_expenses'));
        $this->assertEquals(700, $response->json('balance'));
    }

    public function test_unauthenticated_cannot_access_fund(): void
    {
        $response = $this->getJson('/api/v1/fund');

        $response->assertUnauthorized();
    }

    public function test_can_get_fund_profile(): void
    {
        $profile = FundProfile::current();
        $profile->setTranslation('about', 'ar', 'نبذة عن صندوق القفاري');
        $profile->setTranslation('vision', 'ar', 'الرؤية');
        $profile->save();

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/fund/profile');

        $response->assertOk()
            ->assertJsonStructure(['data' => ['about', 'vision', 'mission', 'goals']]);
    }

    public function test_can_list_active_initiatives_only(): void
    {
        FundInitiative::query()->create([
            'title' => ['ar' => 'مبادرة 1', 'en' => 'Initiative 1'],
            'is_active' => true,
        ]);
        FundInitiative::query()->create([
            'title' => ['ar' => 'مبادرة 2', 'en' => 'Initiative 2'],
            'is_active' => false,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/fund/initiatives');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function test_member_can_submit_support_request(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/fund/support-requests', [
                'title' => 'طلب مساعدة طبية',
                'description' => 'أحتاج مساعدة لتغطية تكاليف عملية جراحية لوالدي.',
                'amount_requested' => 5000,
            ]);

        $response->assertCreated()
            ->assertJsonStructure(['message', 'support_request' => ['id', 'title', 'status']]);

        $this->assertDatabaseHas('support_requests', [
            'user_id' => $this->user->id,
            'title' => 'طلب مساعدة طبية',
            'status' => 'pending',
        ]);
    }

    public function test_member_can_list_only_their_support_requests(): void
    {
        $other = User::factory()->create();
        SupportRequest::create([
            'user_id' => $this->user->id,
            'title' => 'Mine',
            'description' => 'mine desc text',
        ]);
        SupportRequest::create([
            'user_id' => $other->id,
            'title' => 'Other',
            'description' => 'other desc text',
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/v1/fund/support-requests');

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
        $this->assertSame('Mine', $response->json('data.0.title'));
    }

    public function test_support_request_validation(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/fund/support-requests', [
                'title' => '',
                'description' => 'short',
            ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title', 'description']);
    }
}
