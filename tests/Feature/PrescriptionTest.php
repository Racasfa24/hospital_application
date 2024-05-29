<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Prescription;

class PrescriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_prescriptions_can_be_retrieved()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/prescriptions');

        $response->assertStatus(200);
    }

    public function test_prescription_can_be_created()
    {
        $user = User::factory()->create();

        $medicineA = Medicine::factory()->create();
        $medicineB = Medicine::factory()->create();

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalRecord = MedicalRecord::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $response = $this->actingAs($user)->post('/api/prescriptions', [
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed',
            'date' => '2024-04-11',
            'medicines' => [
                [
                    "medicine_id" => $medicineA->id,
                    "indications" => "Before meals, 3 times a day, for 5 days"
                ],
                [
                    "medicine_id" => $medicineB->id,
                    "indications" => "After meals, 2 times a day, for 3 days"
                ]
            ]
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed',
            'date' => '2024-04-11',
            'medicines' => [
                [
                    'id' => $response['medicines'][0]['id'],
                    'name' => $medicineA->name,
                    'pivot' => [
                        'indications' => 'Before meals, 3 times a day, for 5 days',
                    ],
                ],
                [
                    'id' => $response['medicines'][1]['id'],
                    'name' => $medicineB->name,
                    'pivot' => [
                        'indications' => 'After meals, 2 times a day, for 3 days',
                    ],
                ],
            ]
        ]);

        $this->assertDatabaseHas('prescriptions', [
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed',
            'date' => '2024-04-11',
        ]);

        $this->assertDatabaseHas('medicine_prescription', [
            'medicine_id' => $medicineA->id,
            'prescription_id' => $response['id'],
            'indications' => 'Before meals, 3 times a day, for 5 days',
        ]);

        $this->assertDatabaseHas('medicine_prescription', [
            'medicine_id' => $medicineB->id,
            'prescription_id' => $response['id'],
            'indications' => 'After meals, 2 times a day, for 3 days',
        ]);
    }

    public function test_prescription_can_be_retrieved_by_id()
    {
        $user = User::factory()->create();

        $medicineA = Medicine::factory()->create();
        $medicineB = Medicine::factory()->create();

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalRecord = MedicalRecord::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $prescription = Prescription::factory()->create([
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed',
            'date' => '2024-04-11',
        ]);

        $prescription->medicines()->attach([
            $medicineA->id => ['indications' => 'Before meals, 3 times a day, for 5 days'],
            $medicineB->id => ['indications' => 'After meals, 2 times a day, for 3 days'],
        ]);

        $response = $this->actingAs($user)->get("/api/prescriptions/{$prescription->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed',
            'date' => '2024-04-11',
            'medicines' => [
                [
                    'id' => $medicineA->id,
                    'name' => $medicineA->name,
                    'pivot' => [
                        'indications' => 'Before meals, 3 times a day, for 5 days',
                    ],
                ],
                [
                    'id' => $medicineB->id,
                    'name' => $medicineB->name,
                    'pivot' => [
                        'indications' => 'After meals, 2 times a day, for 3 days',
                    ],
                ],
            ]
        ]);
    }

    public function test_prescription_can_be_updated()
    {
        $user = User::factory()->create();

        $medicineA = Medicine::factory()->create();
        $medicineB = Medicine::factory()->create();

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalRecord = MedicalRecord::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $prescription = Prescription::factory()->create([
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed',
            'date' => '2024-04-11',
        ]);

        $prescription->medicines()->attach([
            $medicineA->id => ['indications' => 'Before meals, 3 times a day, for 5 days'],
            $medicineB->id => ['indications' => 'After meals, 2 times a day, for 3 days'],
        ]);

        $response = $this->actingAs($user)->put("/api/prescriptions/{$prescription->id}", [
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed, updated',
            'date' => '2024-04-12',
            'medicines' => [
                [
                    "medicine_id" => $medicineA->id,
                    "indications" => "Before meals, 3 times a day, for 5 days, updated"
                ],
                [
                    "medicine_id" => $medicineB->id,
                    "indications" => "After meals, 2 times a day, for 3 days, updated"
                ]
            ]
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed, updated',
            'date' => '2024-04-12',
            'medicines' => [
                [
                    'id' => $medicineA->id,
                    'name' => $medicineA->name,
                    'pivot' => [
                        'indications' => 'Before meals, 3 times a day, for 5 days, updated',
                    ],
                ],
                [
                    'id' => $medicineB->id,
                    'name' => $medicineB->name,
                    'pivot' => [
                        'indications' => 'After meals, 2 times a day, for 3 days, updated',
                    ],
                ],
            ]
        ]);

        $this->assertDatabaseHas('prescriptions', [
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed, updated',
            'date' => '2024-04-12',
        ]);

        $this->assertDatabaseHas('medicine_prescription', [
            'medicine_id' => $medicineA->id,
            'prescription_id' => $response['id'],
            'indications' => 'Before meals, 3 times a day, for 5 days, updated',
        ]);

        $this->assertDatabaseHas('medicine_prescription', [
            'medicine_id' => $medicineB->id,
            'prescription_id' => $response['id'],
            'indications' => 'After meals, 2 times a day, for 3 days, updated',
        ]);

        $this->assertDatabaseMissing('medicine_prescription', [
            'medicine_id' => $medicineA->id,
            'prescription_id' => $response['id'],
            'indications' => 'Before meals, 3 times a day, for 5 days',
        ]);

        $this->assertDatabaseMissing('medicine_prescription', [
            'medicine_id' => $medicineB->id,
            'prescription_id' => $response['id'],
            'indications' => 'After meals, 2 times a day, for 3 days',
        ]);
    }

    public function test_prescription_can_be_deleted()
    {
        $user = User::factory()->create();

        $medicineA = Medicine::factory()->create();
        $medicineB = Medicine::factory()->create();

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalRecord = MedicalRecord::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $prescription = Prescription::factory()->create([
            'medical_record_id' => $medicalRecord->id,
            'notes' => 'Take the following medicines as prescribed',
            'date' => '2024-04-11',
        ]);

        $prescription->medicines()->attach([
            $medicineA->id => ['indications' => 'Before meals, 3 times a day, for 5 days'],
            $medicineB->id => ['indications' => 'After meals, 2 times a day, for 3 days'],
        ]);

        $response = $this->actingAs($user)->delete("/api/prescriptions/{$prescription->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('prescriptions', [
            'id' => $prescription->id,
        ]);

        $this->assertDatabaseMissing('medicine_prescription', [
            'prescription_id' => $prescription->id,
        ]);
    }
}
