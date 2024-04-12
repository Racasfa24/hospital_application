<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $patients->each(function (Patient $patient) {
            Prescription::factory()
                ->for($patient)
                ->for(Doctor::all()->random())
                ->hasAttached(Medicine::all()->random(), ['indications' => 'tomese una culero'])
                ->create();
        });
    }
}
