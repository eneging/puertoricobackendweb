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
       

        Schema::create('service_types', function (Blueprint $table) {
    $table->id(); // Esto crea: BIGINT UNSIGNED AUTO_INCREMENT
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('base_price_per_hour', 8, 2)->nullable();
    $table->integer('max_capacity')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_types');
    }
};