<?php

namespace Database\Factories;

use App\Models\MemberChild;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MemberChild>
 */
class MemberChildFactory extends Factory
{
    protected $model = MemberChild::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->firstName('male'),
            'gender' => 'male',
            'birthday' => null,
            'linked_user_id' => null,
            'sort_order' => 0,
        ];
    }

    public function male(): static
    {
        return $this->state([
            'gender' => 'male',
            'name' => fake()->firstName('male'),
        ]);
    }

    public function female(): static
    {
        return $this->state([
            'gender' => 'female',
            'name' => fake()->firstName('female'),
        ]);
    }
}
