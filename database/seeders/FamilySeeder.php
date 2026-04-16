<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    public function run(): void
    {
        Family::factory()->create([
            'name' => 'الجربوع',
            'origin' => 'أهل الرس',
        ]);

        Family::factory()->count(4)->create();
    }
}
