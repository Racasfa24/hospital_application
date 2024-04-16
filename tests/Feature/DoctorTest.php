<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Doctor;

class DoctorTest extends TestCase
{
    use RefreshDatabase;

    public function test_doctor_can_be_retrieved()
    {
        $response = $this->getJson('/api/doctors');

        $response->assertStatus(200);
    }

    public function test_doctor_can_be_created()
    {
        $response = $this->postJson('/api/doctors', [
            'name' => 'John',
            'lastname' => 'Doe',
            'speciality' => 'Cardiologist',
            'admission_date' => '2022-01-01',
            'professional_id' => 'b5983e2f-c520-324e-15ab-861d74cc379j',
            'phone_number' => '123456789',
            'email' => 'john.doe@gmail.com',
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'name' => 'John',
            'lastname' => 'Doe',
            'speciality' => 'Cardiologist',
            'admission_date' => '2022-01-01',
            'professional_id' => 'b5983e2f-c520-324e-15ab-861d74cc379j',
            'phone_number' => '123456789',
            'email' => 'john.doe@gmail.com',
        ]);

        $this->assertDatabaseHas('doctors', [
            'name' => 'John',
            'lastname' => 'Doe',
            'speciality' => 'Cardiologist',
            'admission_date' => '2022-01-01',
            'professional_id' => 'b5983e2f-c520-324e-15ab-861d74cc379j',
            'phone_number' => '123456789',
            'email' => 'john.doe@gmail.com',
        ]);
    }

    public function test_doctor_can_be_retrieved_by_id()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->getJson("/api/doctors/{$doctor->id}");

        $response->assertStatus(200);
    }

    public function test_doctor_can_be_updated()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->putJson("/api/doctors/{$doctor->id}", [
            'name' => 'john',
            'lastname' => 'Doe',
            'speciality' => 'Cardiologist',
            'admission_date' => '2022-01-01',
            'professional_id' => 'b5983e2f-c520-324e-15ab-861d74cc379j',
            'phone_number' => '123456789',
            'email' => 'john.doe@gmail.com',
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'name' => 'john',
            'lastname' => 'Doe',
            'speciality' => 'Cardiologist',
            'admission_date' => '2022-01-01',
            'professional_id' => 'b5983e2f-c520-324e-15ab-861d74cc379j',
            'phone_number' => '123456789',
            'email' => 'john.doe@gmail.com',
        ]);

        $this->assertDatabaseHas('doctors', [
            'name' => 'john',
            'lastname' => 'Doe',
            'speciality' => 'Cardiologist',
            'admission_date' => '2022-01-01',
            'professional_id' => 'b5983e2f-c520-324e-15ab-861d74cc379j',
            'phone_number' => '123456789',
            'email' => 'john.doe@gmail.com',
        ]);
    }

    public function test_doctor_can_be_deleted()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->deleteJson("/api/doctors/{$doctor->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('doctors', [
            'id' => $doctor->id,
        ]);
    }
}
