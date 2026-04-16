<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ['ar' => fake('ar_SA')->sentence(4), 'en' => fake()->sentence(4)],
            'content' => ['ar' => fake('ar_SA')->paragraphs(3, true), 'en' => fake()->paragraphs(3, true)],
            'is_urgent' => fake()->boolean(15),
            'published_at' => fake()->optional(0.8)->dateTimeBetween('-3 months', 'now'),
            'time_from' => fake()->optional(0.3)->time('H:i:s'),
            'time_to' => fake()->optional(0.25)->time('H:i:s'),
        ];
    }

    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_urgent' => true,
        ]);
    }
}
