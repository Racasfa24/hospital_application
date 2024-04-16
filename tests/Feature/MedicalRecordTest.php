<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\MedicalRecord;

class MedicalRecordTest extends TestCase
{
    use RefreshDatabase;

    public function test_medical_records_can_be_retrieved()
    {
        $response = $this->get('/api/medical-records');

        $response->assertStatus(200);
    }

    public function test_medical_record_can_be_created()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->post('/api/medical-records', [
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'datetime' => '2021-01-01 10:00'
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'datetime' => '2021-01-01 10:00'
        ]);

        $this->assertDatabaseHas('medical_records', [
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'datetime' => '2021-01-01 10:00'
        ]);
    }

    public function test_medical_record_can_be_retrieved_by_id()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalRecord = MedicalRecord::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $response = $this->get("/api/medical-records/{$medicalRecord->id}");

        $response->assertStatus(200);
    }

    public function test_medical_record_can_be_updated()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalRecord = MedicalRecord::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'datetime' => '2021-01-01 10:00'
        ]);

        $newDoctor = Doctor::factory()->create();
        $newPatient = Patient::factory()->create();

        $response = $this->put("/api/medical-records/{$medicalRecord->id}", [
            'doctor_id' => $newDoctor->id,
            'patient_id' => $newPatient->id,
            'datetime' => '2022-02-11 12:00'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('medical_records', [
            'id' => $medicalRecord->id,
            'doctor_id' => $newDoctor->id,
            'patient_id' => $newPatient->id,
            'datetime' => '2022-02-11 12:00'
        ]);
    }

    public function test_medical_record_can_be_deleted()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalRecord = MedicalRecord::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $response = $this->delete("/api/medical-records/{$medicalRecord->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('medical_records', [
            'id' => $medicalRecord->id
        ]);
    }
}
