<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('status', 'active')->take(5)->get();

        if ($users->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            Offer::factory(rand(1, 2))->create([
                'offered_by' => $user->id,
            ]);
        }
    }
}
