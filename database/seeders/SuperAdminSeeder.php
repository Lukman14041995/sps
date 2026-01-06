<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    if (User::where('email', 'admin@sps.co.id')->exists()) {
        return;
    }

    $user = User::create([
        'name' => 'Super Admin',
        'email' => 'admin@sps.co.id',
        'password' => Hash::make('Admin@123'),
        'email_verified_at' => now(),
        'is_admin' => true,
        'super' => true,
    ]);

    $role = Role::where('slug', 'master')->first();
    $user->roles()->attach($role->id);
}
}
