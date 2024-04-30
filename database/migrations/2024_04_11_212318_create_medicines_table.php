<?php

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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('active_ingredients');
            $table->string('dosage_strength');
            $table->string('dosage_unit');
            $table->string('prescription_info');
            $table->enum('presentation', ['Cápsula', 'Tableta', 'Jarabe']);
            $table->decimal('price', 6, 2);
            $table->unsignedInteger('quantity_in_stock');
            $table->string('supplier_name');
            $table->string('supplier_contact');
            $table->decimal('supplier_cost', 6, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
