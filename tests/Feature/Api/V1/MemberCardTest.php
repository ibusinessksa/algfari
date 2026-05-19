<?php

namespace Tests\Feature\Api\V1;

use App\Models\Family;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberCardTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_card_number_is_auto_generated_on_create(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->member_card_number);
        $this->assertMatchesRegularExpression('/^QF-\d{7}$/', $user->member_card_number);
    }

    public function test_family_generation_is_computed_from_parent(): void
    {
        $root = Family::create(['name' => 'الجذر']);
        $branch = Family::create(['name' => 'فرع', 'parent_family_id' => $root->id]);
        $sub = Family::create(['name' => 'فرع فرعي', 'parent_family_id' => $branch->id]);

        $this->assertSame(1, $root->fresh()->generation);
        $this->assertSame(2, $branch->fresh()->generation);
        $this->assertSame(3, $sub->fresh()->generation);
    }

    public function test_members_can_be_filtered_by_branch(): void
    {
        $viewer = User::factory()->create();
        $root = Family::create(['name' => 'الجذر']);
        $branch = Family::create(['name' => 'فرع', 'parent_family_id' => $root->id]);

        $inBranch = User::factory()->create(['family_id' => $branch->id]);
        $other = Family::create(['name' => 'أخرى']);
        User::factory()->create(['family_id' => $other->id]);

        $response = $this->actingAs($viewer, 'sanctum')
            ->getJson('/api/v1/members?branch_id=' . $root->id);

        $response->assertOk();
        $ids = array_column($response->json('data'), 'id');
        $this->assertContains($inBranch->id, $ids);
    }
}
