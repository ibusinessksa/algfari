<?php

namespace Database\Factories;

use App\Models\MemberDaughter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MemberDaughter>
 */
class MemberDaughterFactory extends Factory
{
    protected $model = MemberDaughter::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->firstName('female'),
            'linked_user_id' => null,
            'sort_order' => 0,
        ];
    }
}
