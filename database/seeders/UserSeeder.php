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
        $employee = Employee::firstOrCreate([
            'uuid' => Uuid::uuid4(),
            'name' => 'test',
            'staffIdentityCardNo' => '123456789',
            'department' => 'Front Office',
            'position' => 'test',
            'dateJoined' => now(),
            'dateInThePresentPosition' => now(),
        ]);

        // Buat user baru terkait karyawan
        $user = User::create([
            'username' => $employee->name,
            'email' => 'test@localhost',
            'role' => 'Karyawan',
            'email_verified_at' => now(),
            'password' => bcrypt('test123'),
            'employee_id' => $employee->uuid,
        ]);
        User::create([
            'username' => 'admin',
            'role' => 'Admin',
            'email' => 'admin@localhost',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
        ]);
        User::create([
            'username' => 'HRD',
            'role' => 'HRD',
            'email' => 'hrd@localhost',
            'email_verified_at' => now(),
            'password' => bcrypt('hrd123'),
        ]);
        User::create([
            'username' => 'HOD',
            'role' => 'HOD',
            'email' => 'hod@localhost',
            'email_verified_at' => now(),
            'password' => bcrypt('hod123'),

        ]);
        User::create([
            'username' => 'GM',
            'role' => 'GM',
            'email' => 'gm@localhost',
            'email_verified_at' => now(),
            'password' => bcrypt('gm123'),
        ]);
    }
}
