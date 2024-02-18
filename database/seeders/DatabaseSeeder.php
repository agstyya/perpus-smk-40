<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'role' => 'admin',
            'username' => 'admin1',
            'password' => bcrypt('Admin1')
        ]);
        \App\Models\User::create([
            'name' => 'Member 1',
            'email' => 'member1@gmail.com',
            'role' => 'member',
            'username' => 'member1',
            'password' => bcrypt('member1')
        ]);
        \App\Models\User::create([
            'name' => 'Librarian 1',
            'email' => 'librarian1@gmail.com',
            'role' => 'librarian',
            'username' => 'librarian1',
            'password' => bcrypt('librarian1')
        ]);
    }
}