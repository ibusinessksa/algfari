<?php

namespace Database\Factories;

use App\Enums\SuggestionStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suggestion>
 */
class SuggestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ['ar' => fake('ar_SA')->sentence(3), 'en' => fake()->sentence(3)],
            'description' => ['ar' => fake('ar_SA')->paragraph(), 'en' => fake()->paragraph()],
            'submitted_by' => User::factory(),
            'status' => SuggestionStatus::Pending,
        ];
    }
}
