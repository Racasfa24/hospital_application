<?php

namespace Database\Factories;

use App\Models\Medicine;
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
            'quantity' =>fake()->numberBetween(1,100),
            'presentation'=> $this->faker->randomElement([Medicine::pCapsule,
                                                          Medicine::pPill,
                                                          Medicine::pSyrup]),
            'description' =>fake()->sentence()
            //
        ];
    }
}
