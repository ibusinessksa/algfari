<?php

namespace Database\Seeders;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Family;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $defaultFamily = Family::query()->first();

        // Create admin user
        User::factory()->create([
            'full_name' => 'مدير النظام',
            'phone_number' => '0500000001',
            'national_id' => '1000000001',
            'email' => 'admin@familytribe.app',
            'password' => Hash::make('password'),
            'gender' => Gender::Male,
            'role' => UserRole::Admin,
            'status' => UserStatus::Active,
        ]);

        // Create regular active members
        User::factory(15)->create();

        // Create some featured members
        User::factory(3)->featured()->create();

        // Create some pending members
        User::factory(5)->pending()->create();
    }
}
