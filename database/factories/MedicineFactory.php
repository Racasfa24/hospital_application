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
        $supplierCost = fake()->randomFloat(2, 4, 20);
        $profit = 1.4;
        $numberOfIngredients = mt_rand(1, 3);
        $arrayOfIngredients = fake()->words($numberOfIngredients);
        $activeIngredients = implode(', ', $arrayOfIngredients);

        return [
            'name' => fake()->domainName(),
            'active_ingredients' => $activeIngredients,
            'dosage_strength' => fake()->numberBetween(1, 100),
            'dosage_unit' => fake()->randomElement(['mg', 'g']),
            'prescription_info' => fake()->sentence(),
            'presentation' => fake()->randomElement(['capsule', 'pill', 'syrup']),
            'price' => $supplierCost * $profit,
            'quantity_in_stock' => fake()->numberBetween(10, 100),
            'supplier_name' => fake()->company(),
            'supplier_contact' => fake()->phoneNumber(),
            'supplier_cost' => $supplierCost,
            'description' => fake()->sentence(),
        ];
    }
}
