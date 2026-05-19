<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuggestionTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_submit_suggestion(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/suggestions', [
                'suggestion' => 'يمكنك أن تكتب هنا مقترحاتك',
            ]);

        $response->assertCreated()
                 ->assertJsonStructure(['message', 'suggestion']);

        $this->assertDatabaseHas('suggestions', [
            'submitted_by' => $this->user->id,
            'suggestion' => 'يمكنك أن تكتب هنا مقترحاتك',
        ]);
    }

    public function test_suggestion_requires_text(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/suggestions', []);

        $response->assertUnprocessable()
                 ->assertJsonValidationErrors(['suggestion']);
    }

    public function test_unauthenticated_cannot_submit_suggestion(): void
    {
        $response = $this->postJson('/api/v1/suggestions', [
            'suggestion' => 'attempt',
        ]);

        $response->assertUnauthorized();
    }

    public function test_can_override_name_and_email(): void
    {
        $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/suggestions', [
                'name' => 'Custom Name',
                'email' => 'custom@example.com',
                'suggestion' => 'something',
            ])
            ->assertCreated();

        $this->assertDatabaseHas('suggestions', [
            'submitted_by' => $this->user->id,
            'name' => 'Custom Name',
            'email' => 'custom@example.com',
        ]);
    }
}
