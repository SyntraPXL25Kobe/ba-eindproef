<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'profile.update',
            'favorites.manage',
            'connections.manage',
            'events.create',
            'events.join',
            'chat.send',
            'notifications.view',
            'admin.users.manage',
            'admin.content.manage',
            'admin.reports.manage',
            'admin.stats.view',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);
        }

        $studentRole = Role::firstOrCreate([
            'name' => 'student',
            'guard_name' => 'web',
        ]);

        $professionalRole = Role::firstOrCreate([
            'name' => 'professional',
            'guard_name' => 'web',
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $studentRole->syncPermissions([
            'profile.update',
            'favorites.manage',
            'connections.manage',
            'events.join',
            'chat.send',
            'notifications.view',
        ]);

        $professionalRole->syncPermissions([
            'profile.update',
            'connections.manage',
            'events.create',
            'chat.send',
            'notifications.view',
        ]);

        $adminRole->syncPermissions(Permission::all());

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
