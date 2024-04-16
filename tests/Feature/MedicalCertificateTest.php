<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\MedicalCertificate;

class MedicalCertificateTest extends TestCase
{
    use RefreshDatabase;

    public function test_medical_certificates_can_be_retrieved()
    {
        $response = $this->getJson('/api/medical-certificates');

        $response->assertStatus(200);
    }

    public function test_medical_certificate_can_be_created()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/medical-certificates', [
            'date' => '2024-04-11',
            'age' => 25,
            'height' => 1.75,
            'weight' => 70,
            'systolic_pressure' => 120,
            'diastolic_pressure' => 80,
            'heart_rate' => 70,
            'respiratory_rate' => 16,
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'date' => '2024-04-11',
            'age' => 25,
            'height' => 1.75,
            'weight' => 70,
            'systolic_pressure' => 120,
            'diastolic_pressure' => 80,
            'heart_rate' => 70,
            'respiratory_rate' => 16,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $this->assertDatabaseHas('medical_certificates', [
            'date' => '2024-04-11',
            'age' => 25,
            'height' => 1.75,
            'weight' => 70,
            'systolic_pressure' => 120,
            'diastolic_pressure' => 80,
            'heart_rate' => 70,
            'respiratory_rate' => 16,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);
    }

    public function test_medical_certificate_can_be_retrieved_by_id()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalCertificate = MedicalCertificate::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $response = $this->getJson("/api/medical-certificates/{$medicalCertificate->id}");

        $response->assertStatus(200);
    }

    public function test_medical_certificate_can_be_updated()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalCertificate = MedicalCertificate::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $response = $this->putJson("/api/medical-certificates/{$medicalCertificate->id}", [
            'date' => '2024-04-11',
            'age' => 25,
            'height' => 1.75,
            'weight' => 70,
            'systolic_pressure' => 120,
            'diastolic_pressure' => 80,
            'heart_rate' => 70,
            'respiratory_rate' => 16,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'date' => '2024-04-11',
            'age' => 25,
            'height' => 1.75,
            'weight' => 70,
            'systolic_pressure' => 120,
            'diastolic_pressure' => 80,
            'heart_rate' => 70,
            'respiratory_rate' => 16,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $this->assertDatabaseHas('medical_certificates', [
            'date' => '2024-04-11',
            'age' => 25,
            'height' => 1.75,
            'weight' => 70,
            'systolic_pressure' => 120,
            'diastolic_pressure' => 80,
            'heart_rate' => 70,
            'respiratory_rate' => 16,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);
    }

    public function test_medical_certificate_can_be_deleted()
    {
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $medicalCertificate = MedicalCertificate::factory()->create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ]);

        $response = $this->deleteJson("/api/medical-certificates/{$medicalCertificate->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('medical_certificates', [
            'id' => $medicalCertificate->id,
        ]);
    }
}
