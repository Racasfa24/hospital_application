<?php

use App\Models\Doctor;
use App\Models\Medicine;
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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Doctor::class);
            $table->foreignIdFor(Medicine::class);
            $table->date('date');
            $table->integer('quantity');
            $table->enum('frequency',['Once a day', 'Twice a day', 'Every 8 hours']);
            $table->enum('duration',['1 week', '2 weeks', '1 month']);
            $table->string('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
