<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create ([
            'NIK' => '123456789',
            'name' => 'Super Admin',
            'email' => 'superadmin@example',
            'password' => bcrypt('password'),
            'role' => 'superadmin'
        ]);
    }
}
