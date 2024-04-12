<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->domainName(),
            'quantity' => fake()->numberBetween(1, 100),
            'presentation' => fake()->randomElement(['capsule', 'pill', 'syrup']),
            'description' => fake()->sentence(),
            //
        ];
    }
}
