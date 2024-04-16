<?php

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Doctor::class);
            $table->date('date');
            $table->unsignedTinyInteger('age');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->unsignedSmallInteger('systolic_pressure');
            $table->unsignedSmallInteger('diastolic_pressure');
            $table->unsignedSmallInteger('heart_rate');
            $table->unsignedSmallInteger('respiratory_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_certificates');
    }
};
