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
                'title' => ['ar' => 'اقتراح جديد', 'en' => 'New suggestion'],
                'description' => ['ar' => 'وصف الاقتراح', 'en' => 'Suggestion description'],
            ]);

        $response->assertCreated()
                 ->assertJsonStructure(['message', 'suggestion']);

        $this->assertDatabaseHas('suggestions', [
            'submitted_by' => $this->user->id,
        ]);
    }

    public function test_suggestion_requires_title(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/suggestions', [
                'description' => ['ar' => 'وصف', 'en' => 'description'],
            ]);

        $response->assertUnprocessable()
                 ->assertJsonValidationErrors(['title']);
    }

    public function test_suggestion_requires_description(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/suggestions', [
                'title' => ['ar' => 'عنوان', 'en' => 'title'],
            ]);

        $response->assertUnprocessable()
                 ->assertJsonValidationErrors(['description']);
    }

    public function test_suggestion_requires_english_title_and_description(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/v1/suggestions', [
                'title' => ['ar' => 'عنوان فقط'],
                'description' => ['ar' => 'وصف فقط'],
            ]);

        $response->assertUnprocessable()
                 ->assertJsonValidationErrors(['title.en', 'description.en']);
    }

    public function test_unauthenticated_cannot_submit_suggestion(): void
    {
        $response = $this->postJson('/api/v1/suggestions', [
            'title' => ['ar' => 'عنوان', 'en' => 'title'],
            'description' => ['ar' => 'وصف', 'en' => 'desc'],
        ]);

        $response->assertUnauthorized();
    }
}
