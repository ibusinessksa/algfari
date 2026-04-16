<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyFundTransaction>
 */
class FamilyFundTransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'contributor_id' => User::factory(),
            'amount' => fake()->randomFloat(2, 50, 10000),
            'transaction_type' => fake()->randomElement(TransactionType::cases()),
            'description' => ['ar' => fake('ar_SA')->sentence(), 'en' => fake()->sentence()],
            'status' => TransactionStatus::Pending,
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TransactionStatus::Approved,
            'approved_by' => User::factory()->admin(),
            'approved_at' => now(),
        ]);
    }
}
