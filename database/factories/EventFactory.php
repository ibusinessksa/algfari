<?php

namespace Database\Factories;

use App\Enums\EventType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        $eventDate = fake()->dateTimeBetween('+1 week', '+3 months');

        return [
            'title' => ['ar' => fake('ar_SA')->sentence(3), 'en' => fake()->sentence(3)],
            'description' => ['ar' => fake('ar_SA')->paragraph(), 'en' => fake()->paragraph()],
            'event_type' => fake()->randomElement(EventType::cases()),
            'event_date' => $eventDate,
            'end_date' => fake()->optional(0.5)->dateTimeBetween($eventDate, '+4 months'),
            'location_name' => fake()->optional()->address(),
            'location_lat' => fake()->optional()->latitude(20, 30),
            'location_lng' => fake()->optional()->longitude(35, 55),
            'is_active' => true,
            'created_by' => User::factory(),
        ];
    }
}
