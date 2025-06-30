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
      Schema::create('reservable_items', function (Blueprint $table) {
    $table->id(); // crea BIGINT UNSIGNED automáticamente
    $table->string('name');
    $table->decimal('price', 8, 2);
    $table->foreignId('service_type_id')->constrained('service_types');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservable_items');
    }
};