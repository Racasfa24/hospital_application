<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        return [
        'date' => fake()->date(),
        'quantity' => fake()->numberBetween(1, 10),
        'frequency' => fake()->randomElement(['Once a day', 'Twice a day', 'Every 8 hours']),
        'duration' => fake()->randomElement(['1 week', '2 weeks', '1 month']),
        'notes' => fake()->text(),
        ];
    }
}
