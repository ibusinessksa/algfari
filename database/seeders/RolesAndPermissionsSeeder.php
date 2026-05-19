<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // Users / members
            'users.view', 'users.create', 'users.update', 'users.delete',
            'members.update_any',

            // Families
            'families.view', 'families.create', 'families.update', 'families.delete',

            // News
            'news.view', 'news.create', 'news.update', 'news.delete',
            'news_comments.moderate',

            // Events
            'events.view', 'events.create', 'events.update', 'events.delete',

            // Offers
            'offers.view', 'offers.create', 'offers.update', 'offers.delete',

            // Fund
            'fund.view', 'fund.manage', 'support_requests.review',

            // Suggestions
            'suggestions.view', 'suggestions.review',

            // Broadcasts
            'broadcasts.send',

            // Settings
            'settings.manage',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        $owner = Role::firstOrCreate(['name' => UserRole::Owner->value, 'guard_name' => 'web']);
        $owner->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => UserRole::Admin->value, 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        $memberRole = Role::firstOrCreate(['name' => UserRole::Member->value, 'guard_name' => 'web']);
        $memberRole->syncPermissions([
            'news.view', 'events.view', 'offers.view', 'fund.view',
            'families.view', 'users.view', 'suggestions.view',
        ]);

        $businessOwner = Role::firstOrCreate(['name' => UserRole::FamilyBusinessOwner->value, 'guard_name' => 'web']);
        $businessOwner->syncPermissions(array_merge(
            $memberRole->permissions->pluck('name')->all(),
            ['offers.create', 'offers.update']
        ));

        $partner = Role::firstOrCreate(['name' => UserRole::ExternalPartner->value, 'guard_name' => 'web']);
        $partner->syncPermissions(['offers.create', 'offers.update', 'offers.view']);
    }
}
