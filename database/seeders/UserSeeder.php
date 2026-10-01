<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        $user = User::firstOrCreate(
            [
                'email' => 'admin@erp.com'
            ],
            [
                'name' => 'System Administrator',
                'password' => bcrypt('password'),
                'is_active' => true,
            ]
        );


        $user->assignRole('super_admin');
    }
}
