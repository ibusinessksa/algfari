<?php

namespace Database\Factories;

use App\Enums\OfferCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ['ar' => fake('ar_SA')->sentence(3), 'en' => fake()->sentence(3)],
            'description' => ['ar' => fake('ar_SA')->paragraph(), 'en' => fake()->paragraph()],
            'category' => fake()->randomElement(OfferCategory::cases()),
            'service_address' => fake()->optional()->address(),
            'contact_phone' => fake()->numerify('05########'),
            'contact_whatsapp' => fake()->optional()->numerify('05########'),
            'is_active' => true,
            'offered_by' => User::factory(),
            'expires_at' => fake()->optional(0.5)->dateTimeBetween('+1 week', '+6 months'),
        ];
    }
}
