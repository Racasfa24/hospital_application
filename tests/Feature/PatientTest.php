<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Patient;
use App\Models\User;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_be_retrieved()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/patients');

        $response->assertStatus(200);
    }

    public function test_patient_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/patients', [
            'name' => 'John',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
            'curp' => 'ABC123456DEF789GHI'
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'name' => 'John',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
            'curp' => 'ABC123456DEF789GHI'
        ]);

        $this->assertDatabaseHas('patients', [
            'name' => 'John',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
            'curp' => 'ABC123456DEF789GHI'
        ]);
    }

    public function test_patient_can_be_retrieved_by_id()
    {
        $user = User::factory()->create();

        $patient = Patient::factory()->create();

        $response = $this->actingAs($user)->getJson("/api/patients/{$patient->id}");

        $response->assertStatus(200);
    }

    public function test_patient_can_be_updated()
    {
        $user = User::factory()->create();

        $patient = Patient::factory()->create();

        $response = $this->actingAs($user)->putJson("/api/patients/{$patient->id}", [
            'name' => 'Jane',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
            'curp' => 'ABC123456DEF789GHI'
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'name' => 'Jane',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
            'curp' => 'ABC123456DEF789GHI'
        ]);

        $this->assertDatabaseHas('patients', [
            'name' => 'Jane',
            'lastname' => 'Doe',
            'birth_date' => '2022-01-01',
            'affiliation_date' => '2022-01-01',
            'phone_number' => '123456789',
            'blood_type' => 'A+',
            'curp' => 'ABC123456DEF789GHI'
        ]);
    }

    public function test_patient_can_be_deleted()
    {
        $user = User::factory()->create();

        $patient = Patient::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/api/patients/{$patient->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('patients', [
            'id' => $patient->id,
        ]);
    }
}
