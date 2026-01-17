<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Menu;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Buat roles
        $master = Role::firstOrCreate(['name' => 'Master', 'slug' => 'master']);
        $editor = Role::firstOrCreate(['name' => 'Editor', 'slug' => 'editor']);
        $user   = Role::firstOrCreate(['name' => 'User', 'slug' => 'user']);

        // Assign menu ke Master (akses semua)
        $master->menus()->sync(Menu::pluck('id'));

        // Assign menu ke Editor (misal hanya menu 1-4)
        $editor->menus()->sync([1,2,3,4]);

        // Assign menu ke User (misal menu Dashboard + News)
        $user->menus()->sync([1,2]);
    }
}
