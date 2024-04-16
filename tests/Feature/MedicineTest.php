<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Medicine;

class MedicineTest extends TestCase
{
    use RefreshDatabase;

    public function test_medicines_can_be_retrieved()
    {
        $response = $this->get('/api/medicines');

        $response->assertStatus(200);
    }

    public function test_medicine_can_be_created()
    {
        $response = $this->post('/api/medicines', [
            'name' => 'Medicine 1',
            'quantity' => 10,
            'presentation' => 'pill',
            'description' => 'This is a medicine'
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'name' => 'Medicine 1',
            'quantity' => 10,
            'presentation' => 'pill',
            'description' => 'This is a medicine'
        ]);

        $this->assertDatabaseHas('medicines', [
            'name' => 'Medicine 1',
            'quantity' => 10,
            'presentation' => 'pill',
            'description' => 'This is a medicine'
        ]);
    }

    public function test_medicine_can_be_retrieved_by_id()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->get("/api/medicines/{$medicine->id}");

        $response->assertStatus(200);

        $response->assertJson($medicine->toArray());
    }

    public function test_medicine_can_be_updated()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->put("/api/medicines/{$medicine->id}", [
            'name' => 'Medicine 2',
            'quantity' => 20,
            'presentation' => 'capsule',
            'description' => 'This is another medicine'
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'name' => 'Medicine 2',
            'quantity' => 20,
            'presentation' => 'capsule',
            'description' => 'This is another medicine'
        ]);

        $this->assertDatabaseHas('medicines', [
            'name' => 'Medicine 2',
            'quantity' => 20,
            'presentation' => 'capsule',
            'description' => 'This is another medicine'
        ]);
    }

    public function test_medicine_can_be_deleted()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->delete("/api/medicines/{$medicine->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('medicines', [
            'id' => $medicine->id
        ]);
    }
}
