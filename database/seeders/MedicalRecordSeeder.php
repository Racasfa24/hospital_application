<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();

        $patients->each(function (Patient $patient) {
            MedicalRecord::factory()
                ->for($patient)
                ->for(Doctor::all()->random())
                ->create();
        });
    }
}
