<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\MedicalCertificate;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class MedicalCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $patients->each(function (Patient $patient) {
            MedicalCertificate::factory()
                ->for($patient)
                ->for(Doctor::all()->random())
                ->create();
        });
    }
}
