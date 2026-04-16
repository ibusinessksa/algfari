<?php

namespace Tests\Feature\Api\V1;

use App\Models\FamilyFundTransaction;
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
}
