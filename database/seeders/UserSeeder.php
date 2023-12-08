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
        User::create([
            'username' => 'admin',
            'role' => 'admin',
            'email' => 'admin@localhost',
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'username' => 'user',
            'role' => 'user',
            'email' => 'user@localhost',
            'password' => bcrypt('12345678'),
        ]);
    }
}
