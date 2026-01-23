<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [4, 'Career', 'admin.career.index', 'fas fa-briefcase', 4, null, 7, null],
            [1, 'Dashboard', 'admin.dashboard', 'fas fa-tachometer-alt', 1, null, null, null],
            [2, 'News', 'admin.news.index', 'far fa-newspaper', 2, null, 42, null],
            [3, 'CSR', 'admin.csr.index', 'fas fa-hands-helping', 3, null, 18, null],
            [5, 'Messages', 'admin.contact.index', 'far fa-envelope', 5, null, 5, null],
            [6, 'Business Units', 'admin.bisnis-unit.index', 'far fa-building', 6, 'master', null, null],
            [7, 'User Management', 'admin.users.index', 'fas fa-users', 7, 'master', null, null],
            [8, 'News Categories', 'admin.news-categories.index', 'fas fa-list', 8, null, 5, null],
            [9, 'Master Category CSR', 'admin.category-csr.index', 'fas fa-layer-group', 9, 'master', null, null],
            [10, 'Master Category Loker', 'admin.category-loker.index', 'fas fa-briefcase', 10, 'master', null, null],
            [11, 'Master Bisnis Kategori', 'admin.bisnis-kategori.index', 'fas fa-store', 11, 'master', null, null],
            [12, 'Menu', 'admin.menus.index', 'fas fa-rectangle-list', 12, null, null, null],
            [13, 'User Settings', 'admin.roles.index', 'fas fa-users', 13, null, null, null],
            [14, 'System Settings', 'admin.roles.index', 'fas fa-cog', 14, null, null, null],
        ];

        foreach ($menus as $m) {
            DB::table('menus')->updateOrInsert(
                ['id' => $m[0]],
                [
                    'title'     => $m[1],
                    'route'     => $m[2],
                    'icon'      => $m[3],
                    'order'     => $m[4],
                    'roles'     => $m[5],
                    'count'     => $m[6],
                    'parent_id' => $m[7],
                ]
            );
        }
    }
}
