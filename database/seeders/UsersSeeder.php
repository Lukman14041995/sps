<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [3, 'lukman', 'lukmantest@gmail.com', null],
            [7, 'ujicoba', 'ujicoba@gmail.com', '$2y$12$0sA9FUG3Qr38tED0CRisIeamveaxZPdTj/7vNoyZbyAo/4nUWPxH.'],
            [5, 'testlukman', 'testlukman@gmail.com', '$2y$12$O/SWhdsHEcf3Mp7noxgEiueqrg73LZL8vwbJs74IfSKrW.ul0y44.'],
            [2, 'Super Admin', 'admin@sps.co.id', '$2y$12$RC/vszUcnE90EmcgLMI51ukT.KYTFBpNC1BXj1CB46wxUXNnpBYp6'],
            [4, 'lukman123', 'lukman123@gmail.com', '$2y$12$RC/vszUcnE90EmcgLMI51ukT.KYTFBpNC1BXj1CB46wxUXNnpBYp6'],
            [6, 'adi', 'adi@gmail.com', '$2y$12$JtkyeYB0Mgyjk9DLL/m/B.ZJdX174Lb9lK7bc7Ueq6oBF4/jgwQYi'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['id' => $u[0]],
                [
                    'name' => $u[1],
                    'email' => $u[2],
                    'password' => $u[3],
                    'must_change_password' => true,
                ]
            );
        }
    }
}
