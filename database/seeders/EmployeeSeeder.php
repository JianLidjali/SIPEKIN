<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Employee::create([
            'name' => $faker->name,
            'staffIdentityCardNo' => $faker->unique()->ean8,
            'department' => $faker->randomElement(['Front Office', 'Housekeeping', 'Engineering', 'Accounting', 'Sales', 'FBS', 'FBP', 'HC & Security']),
            'position' => $faker->word,
            'dateJoined' => $faker->date,
            'dateInThePresentPosition' => $faker->date,
        ]);
    }
}
