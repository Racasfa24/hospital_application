<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => fake()->name(),
        'lastname' => fake()->lastName(),
        'birth_date' => fake()->date(),
        'affiliation_date' => fake()->date(),
        'phone_number' => fake()->phoneNumber(),
        'blood_type'=> $this->faker->randomElement([Patient::bloodA, Patient::bloodAN,
                                                    Patient::bloodB, Patient::bloodBN,
                                                    Patient::bloodAB, Patient::bloodABN,
                                                    Patient::bloodO, Patient::bloodON])
            //
        ];
    }
}
