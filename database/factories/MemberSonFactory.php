<?php

namespace Database\Factories;

use App\Models\MemberSon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MemberSon>
 */
class MemberSonFactory extends Factory
{
    protected $model = MemberSon::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->firstName('male'),
            'linked_user_id' => null,
            'sort_order' => 0,
        ];
    }
}
