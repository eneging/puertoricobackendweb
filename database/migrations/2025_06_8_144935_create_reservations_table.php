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
        Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users');
    $table->foreignId('reservable_item_id')->constrained('reservable_items');
    $table->date('reservation_date');
    $table->time('start_time');
    $table->time('end_time');
    $table->integer('number_of_people');
    $table->decimal('total_price', 8, 2);
    $table->string('status')->default('Pendiente');
    $table->text('notes')->nullable();
    $table->timestamps();
});



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};