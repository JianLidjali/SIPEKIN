<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory(20)
            ->create()
            ->each(function ($employee) {
                // Membuat username yang unik dari name
                $username = $employee->name;

                // Membuat user dengan username sesuai dengan name
                $user = User::factory()->create([
                    'username' => $username,
                    'employee_id' => $employee->uuid
                ]);

                // Mengupdate name di tabel employees sesuai username
                $employee->update(['name' => $user->username]);
            });

        User::create([
            'username' => 'admin',
            'role' => 'Admin',
            'email' => 'admin@localhost',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
        ]);
    }
}
