<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Family>
 */
class FamilyFactory extends Factory
{
    protected $model = Family::class;

    public function definition(): array
    {
        return [
            'name' => 'عائلة '.fake()->unique()->numerify('####'),
            'origin' => fake()->optional()->city(),
        ];
    }
}
