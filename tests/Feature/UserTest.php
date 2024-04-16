<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_retrieved()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
    }

    public function test_user_can_be_created()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@gmail.com',
            'password' => 'password',
            'phone_number' => '123456789',
            'role' => 'receptionist',
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'name' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@gmail.com',
            'phone_number' => '123456789',
            'role' => 'receptionist',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@gmail.com',
            'phone_number' => '123456789',
            'role' => 'receptionist',
        ]);
    }

    public function test_user_can_be_retrieved_by_id()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200);
    }

    public function test_user_can_be_updated()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'john',
            'lastname' => 'Doe',
            'email' => 'john.doe@gmail.com',
            'password' => 'password',
            'phone_number' => '123456789',
            'role' => 'receptionist',
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'name' => 'john',
            'lastname' => 'Doe',
            'email' => 'john.doe@gmail.com',
            'phone_number' => '123456789',
            'role' => 'receptionist',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'john',
            'lastname' => 'Doe',
            'email' => 'john.doe@gmail.com',
            'phone_number' => '123456789',
            'role' => 'receptionist',
        ]);
    }

    public function test_user_can_be_deleted()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(204);
    }
}
