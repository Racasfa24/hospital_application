<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Patient;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_be_retrieved()
    {
        $response = $this->getJson('/api/patients');

        $response->assertStatus(200);
    }

    public function test_patient_can_be_created()
    {
        $response = $this->postJson('/api/patients', [
            'name' => 'John',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'name' => 'John',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
        ]);

        $this->assertDatabaseHas('patients', [
            'name' => 'John',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
        ]);
    }

    public function test_patient_can_be_retrieved_by_id()
    {
        $patient = Patient::factory()->create();

        $response = $this->getJson("/api/patients/{$patient->id}");

        $response->assertStatus(200);
    }

    public function test_patient_can_be_updated()
    {
        $patient = Patient::factory()->create();

        $response = $this->putJson("/api/patients/{$patient->id}", [
            'name' => 'Jane',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'name' => 'Jane',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
        ]);

        $this->assertDatabaseHas('patients', [
            'name' => 'Jane',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
        ]);
    }

    public function test_patient_can_be_deleted()
    {
        $patient = Patient::factory()->create();

        $response = $this->deleteJson("/api/patients/{$patient->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('patients', [
            'id' => $patient->id,
        ]);
    }
}
