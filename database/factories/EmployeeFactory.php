<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $employee = Employee::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'staffIdentityCardNo' => $this->faker->unique()->ean8,
            'department' => $this->faker->randomElement(['Front Office', 'Housekeeping', 'Engineering', 'Accounting', 'Sales', 'FBS', 'FBP', 'HC & Security']),
            'position' => $this->faker->word,
            'dateJoined' => $this->faker->date,
            'dateInThePresentPosition' => $this->faker->date,
        ];
    }
}
