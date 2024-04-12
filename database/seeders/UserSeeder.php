<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->administrator()->create([
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        User::factory()->receptionist()->create([
            'email' => 'receptionist@receptionist.com',
            'password' => 'receptionist',
        ]);
    }
}
