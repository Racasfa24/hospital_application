<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(base_path('/database/data/medicines.json'));
        $medicines = json_decode($jsonData, true);

        foreach($medicines as $medicineData) {
            Medicine::create($medicineData);
        }
    }
}
