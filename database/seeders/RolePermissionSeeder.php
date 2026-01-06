<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ===== ROLES =====
        $master = Role::firstOrCreate([
            'slug' => 'master'
        ], [
            'name' => 'Master'
        ]);

        $admin = Role::firstOrCreate([
            'slug' => 'admin'
        ], [
            'name' => 'Admin'
        ]);

        $user = Role::firstOrCreate([
            'slug' => 'user'
        ], [
            'name' => 'User'
        ]);

        // ===== PERMISSIONS =====
        $permissions = [
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'view_dashboard',
            'edit_content',
        ];

        $permissionModels = [];

        foreach ($permissions as $perm) {
            $permissionModels[] = Permission::firstOrCreate([
                'slug' => $perm
            ], [
                'name' => ucwords(str_replace('_', ' ', $perm))
            ]);
        }

        // ===== ATTACH PERMISSIONS =====
        $master->permissions()->sync(
            collect($permissionModels)->pluck('id')->toArray()
        );

        $admin->permissions()->sync(
            Permission::whereIn('slug', [
                'view_dashboard',
                'edit_content'
            ])->pluck('id')->toArray()
        );

        // user tidak perlu permission khusus
    }
}
