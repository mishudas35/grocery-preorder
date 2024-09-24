<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create Admin User
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Manager User
        \App\Models\User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);
    }
}
