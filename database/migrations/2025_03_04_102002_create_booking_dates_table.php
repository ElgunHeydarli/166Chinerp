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
        Schema::create('booking_dates', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->integer('count')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('total_price')->nullable();
            $table->decimal('total_cbm')->nullable();
            $table->decimal('remainder_cbm')->nullable();
            $table->integer('remainder_count')->nullable();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->foreignId('container_type_id')->constrained('container_types')->onDelete('cascade');
            $table->foreignId('station_id')->constrained('stations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_dates');
    }
};
