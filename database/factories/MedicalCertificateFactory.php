<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MedicalCertificateFactory extends Factory
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
            'age' => fake()->numberBetween(1, 100),
            'height' => fake()->numberBetween(145, 200),
            'weight' => fake()->randomFloat(2, 50, 120),
            'systolic_pressure' => fake()->numberBetween(50, 120),
            'diastolic_pressure' => fake()->numberBetween(60, 80),
            'hearth_rate' => fake()->numberBetween(60, 120),
            'respiratory_rate' => fake()->numberBetween(12, 18),
        ];
    }
}
