<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Dashboard
        Menu::create([
            'title' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon'  => 'fas fa-tachometer-alt',
            'roles' => null,
            'order' => 1,
            'parent_id' => null,
            'count' => null,
        ]);

        // News
        Menu::create([
            'title' => 'News',
            'route' => 'admin.news.index',
            'icon'  => 'far fa-newspaper',
            'roles' => null,
            'order' => 2,
            'parent_id' => null,
            'count' => 42,
        ]);

        // CSR
        Menu::create([
            'title' => 'CSR',
            'route' => 'admin.csr.index',
            'icon'  => 'fas fa-hands-helping',
            'roles' => null,
            'order' => 3,
            'parent_id' => null,
            'count' => 18,
        ]);

        // Career
        Menu::create([
            'title' => 'Career',
            'route' => 'admin.career.index',
            'icon'  => 'fas fa-briefcase',
            'roles' => null,
            'order' => 4,
            'parent_id' => null,
            'count' => 7,
        ]);

        // Messages
        Menu::create([
            'title' => 'Messages',
            'route' => 'admin.contact.index',
            'icon'  => 'far fa-envelope',
            'roles' => null,
            'order' => 5,
            'parent_id' => null,
            'count' => 5,
        ]);

        // Master only
        Menu::create([
            'title' => 'Business Units',
            'route' => 'admin.bisnis-unit.index',
            'icon'  => 'far fa-building',
            'roles' => 'master',
            'order' => 6,
            'parent_id' => null,
            'count' => null,
        ]);

        Menu::create([
            'title' => 'User Management',
            'route' => 'admin.users.index',
            'icon'  => 'fas fa-users',
            'roles' => 'master',
            'order' => 7,
            'parent_id' => null,
            'count' => null,
        ]);

        // Settings
        Menu::create([
            'title' => 'News Categories',
            'route' => 'admin.news-categories.index',
            'icon'  => 'fas fa-list',
            'roles' => null,
            'order' => 8,
            'parent_id' => null,
            'count' => 5,
        ]);

        Menu::create([
            'title' => 'Master Category CSR',
            'route' => 'admin.category-csr.index',
            'icon'  => 'fas fa-layer-group',
            'roles' => 'master',
            'order' => 9,
            'parent_id' => null,
            'count' => null,
        ]);

        Menu::create([
            'title' => 'Master Category Loker',
            'route' => 'admin.category-loker.index',
            'icon'  => 'fas fa-briefcase',
            'roles' => 'master',
            'order' => 10,
            'parent_id' => null,
            'count' => null,
        ]);

        Menu::create([
            'title' => 'Master Bisnis Kategori',
            'route' => 'admin.bisnis-kategori.index',
            'icon'  => 'fas fa-store',
            'roles' => 'master',
            'order' => 11,
            'parent_id' => null,
            'count' => null,
        ]);

        Menu::create([
            'title' => 'Menu',
            'route' => 'admin.menus.index',
            'icon'  => 'fas fa-rectangle-list',
            'roles' => null,
            'order' => 12,
            'parent_id' => null,
            'count' => null,
        ]);

        Menu::create([
            'title' => 'User Settings',
            'route' => '#',
            'icon'  => 'fas fa-users',
            'roles' => null,
            'order' => 13,
            'parent_id' => null,
            'count' => null,
        ]);

        Menu::create([
            'title' => 'System Settings',
            'route'  => '#',
            'icon'   => 'fas fa-cog',
            'roles'  => null,
            'order'  => 14,
            'parent_id' => null,
            'count'  => null,
        ]);
    }
}
