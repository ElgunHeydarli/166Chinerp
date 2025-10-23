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
        Schema::create('booking_date_payments', function (Blueprint $table) {
            $table->id();
            $table->date('entry_to_warehouse_date');
            $table->decimal('price');
            $table->string('currency')->nullable();
            $table->string('file')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('booking_date_id')->constrained('booking_dates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_date_payments');
    }
};
