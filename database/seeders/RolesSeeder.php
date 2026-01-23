<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Master', 'slug' => 'master'],
            ['id' => 2, 'name' => 'Admin', 'slug' => 'admin'],
            ['id' => 3, 'name' => 'HR', 'slug' => 'hr'],
            ['id' => 5, 'name' => 'User', 'slug' => 'user'],
            ['id' => 6, 'name' => 'Editor', 'slug' => 'editor'],
            ['id' => 7, 'name' => 'dsds', 'slug' => 'dsds'],
        ];

        foreach ($roles as $r) {
            Role::updateOrCreate(['id' => $r['id']], $r);
        }
    }
}
