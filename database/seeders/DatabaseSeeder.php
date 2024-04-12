<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\User;
use App\Models\Prescription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Administrators
        User::factory()->administrator()->create([
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        // Receptionists
        User::factory()->receptionist()->create([
            'email' => 'receptionist@receptionist.com',
            'password' => 'receptionist',
        ]);

        User::factory()->receptionist()->count(2)->create();

        // Doctors
        Doctor::factory()->count(10)->create();

        // Patients
        Patient::factory()->count(10)->create();

        // Medicines
        Medicine::factory()->count(10)->create();

        // Prescriptions
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
