<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Admin Guard Permissions
        $adminPermissions = [
            'view.category',
            'create.category',
            'update.category',
            'delete.category',
            'view.product',
            'create.product',
            'update.product',
            'delete.product',
            'view.order',
            'create.order',
            'update.order',
            'delete.order',
            'view.user',
            'create.user',
            'update.user',
            'delete.user',
            'view.role',
            'create.role',
            'update.role',
            'delete.role',
        ];

        foreach ($adminPermissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }

        // Web Guard Permissions
        $webPermissions = [
            'view.category',
            'create.category',
            'update.category',
            'delete.category',
            'view.product',
            'create.product',
            'update.product',
            'delete.product',
            'view.order',
            'create.order',
            'update.order',
            'delete.order',
        ];

        foreach ($webPermissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Admin Role with admin guard
        $admin_role = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $admin_role->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        // User Role with web guard
        $user_role = Role::create(['name' => 'user', 'guard_name' => 'web']);
        $user_role->givePermissionTo(Permission::where('guard_name', 'web')->get());
    }
}
