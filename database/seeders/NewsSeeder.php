<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('status', 'active')->doesntExist()) {
            return;
        }

        News::factory(2)->urgent()->create();
        News::factory(rand(3, 8))->create();
    }
}
