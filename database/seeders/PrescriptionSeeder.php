<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\MedicalRecord;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PrescriptionSeeder extends Seeder
{
    /**
     
Run the database seeds. **/
  public function run(): void{$faker = Faker::create();$patients = Patient::all();$doctors = Doctor::all();$medicines = Medicine::all();

        $patients->each(function (Patient $patient) use ($doctors, $medicines, $faker) {
            $doctor = $doctors->random();

            $patient = Patient::factory()->create();

            $medicalRecord = MedicalRecord::factory()
                ->for($doctor)
                ->for($patient)
                ->create();

            $medicine = $medicines->random();
            
            Prescription::factory()
                ->for($medicalRecord)
                ->create([
                   
                ]);
        });
    }
}