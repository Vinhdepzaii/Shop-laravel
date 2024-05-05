<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'super-admin', 'display_name' => 'Super Admin', 'group' => 'system', 'guard_name' => 'web'],

            ['name' => 'admin', 'display_name' => 'Admin', 'group' => 'system', 'guard_name' => 'web'],

            ['name' => 'employee', 'display_name' => 'employee', 'group' => 'system', 'guard_name' => 'web'],

            ['name' => 'manager', 'display_name' => 'manager', 'group' => 'system', 'guard_name' => 'web'],

            ['name' => 'user', 'display_name' => 'user', 'group' => 'system', 'guard_name' => 'web'],

        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }


        $permissions = [
            ['name' => 'create-user', 'display_name' => 'Create user', 'group' => 'User', 'guard_name' => 'web'],
            ['name' => 'update-user', 'display_name' => 'Update user', 'group' => 'User', 'guard_name' => 'web'],
            ['name' => 'show-user', 'display_name' => 'Show user', 'group' => 'User', 'guard_name' => 'web'],
            ['name' => 'delete-user', 'display_name' => 'Delete user', 'group' => 'User', 'guard_name' => 'web'],

            ['name' => 'create-role', 'display_name' => 'Create Role', 'group' => 'Role', 'guard_name' => 'web'],
            ['name' => 'update-role', 'display_name' => 'Update Role', 'group' => 'Role', 'guard_name' => 'web'],
            ['name' => 'show-role', 'display_name' => 'Show Role', 'group' => 'Role', 'guard_name' => 'web'],
            ['name' => 'delete-role', 'display_name' => 'Delete Role', 'group' => 'Role', 'guard_name' => 'web'],

            ['name' => 'create-category', 'display_name' => 'Create category', 'group' => 'category', 'guard_name' => 'web'],
            ['name' => 'update-category', 'display_name' => 'Update category', 'group' => 'category', 'guard_name' => 'web'],
            ['name' => 'show-category', 'display_name' => 'Show category', 'group' => 'category', 'guard_name' => 'web'],
            ['name' => 'delete-category', 'display_name' => 'Delete category', 'group' => 'category', 'guard_name' => 'web'],

            ['name' => 'create-product', 'display_name' => 'Create product', 'group' => 'product', 'guard_name' => 'web'],
            ['name' => 'update-product', 'display_name' => 'Update product', 'group' => 'product', 'guard_name' => 'web'],
            ['name' => 'show-product', 'display_name' => 'Show product', 'group' => 'product', 'guard_name' => 'web'],
            ['name' => 'delete-product', 'display_name' => 'Delete product', 'group' => 'product', 'guard_name' => 'web'],

            ['name' => 'create-order', 'display_name' => 'Create order', 'group' => 'order', 'guard_name' => 'web'],
            ['name' => 'update-order', 'display_name' => 'Update order', 'group' => 'order', 'guard_name' => 'web'],
            ['name' => 'show-order', 'display_name' => 'Show order', 'group' => 'order', 'guard_name' => 'web'],
            ['name' => 'delete-order', 'display_name' => 'Delete order', 'group' => 'order', 'guard_name' => 'web'],

            ['name' => 'create-brand', 'display_name' => 'Create brand', 'group' => 'brand', 'guard_name' => 'web'],
            ['name' => 'update-brand', 'display_name' => 'Update brand', 'group' => 'brand', 'guard_name' => 'web'],
            ['name' => 'show-brand', 'display_name' => 'Show brand', 'group' => 'brand', 'guard_name' => 'web'],
            ['name' => 'delete-brand', 'display_name' => 'Delete brand', 'group' => 'brand', 'guard_name' => 'web'],

            ['name' => 'create-permission', 'display_name' => 'Create permission', 'group' => 'permission', 'guard_name' => 'web'],
            ['name' => 'update-permission', 'display_name' => 'Update permission', 'group' => 'permission', 'guard_name' => 'web'],
            ['name' => 'show-permission', 'display_name' => 'Show permission', 'group' => 'permission', 'guard_name' => 'web'],
            ['name' => 'delete-permission', 'display_name' => 'Delete permission', 'group' => 'permission', 'guard_name' => 'web'],
        ];
        foreach ($permissions as $item) {
            Permission::updateOrCreate($item);
        }
    }
}
