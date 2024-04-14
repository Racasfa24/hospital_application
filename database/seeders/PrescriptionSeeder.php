<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PrescriptionSeeder extends Seeder
{
    /**
     
Run the database seeds. **/
  public function run(): void{$faker = Faker::create();$patients = Patient::all();$doctors = Doctor::all();$medicines = Medicine::all();

        $patients->each(function (Patient $patient) use ($doctors, $medicines, $faker) {
            $doctor = $doctors->random();

            $medicine = $medicines->random();

            Prescription::factory()
                ->for($patient)
                ->for($doctor)
                ->create([
                    'medicine_id' => $medicine->id
                ]);
        });
    }
}