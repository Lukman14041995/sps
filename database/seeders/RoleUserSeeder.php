<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [5, 5, 1],
            [6, 6, 1],
            [9, 7, 2],
            [10, 2, 5],
            [12, 4, 5],
            [14, 3, 3],
        ];

        foreach ($data as $d) {
            DB::table('role_user')->updateOrInsert(
                ['id' => $d[0]],
                ['user_id' => $d[1], 'role_id' => $d[2]]
            );
        }
    }
}
