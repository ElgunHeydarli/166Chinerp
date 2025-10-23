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
        Schema::create('booking_date_containers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_date_id')->constrained('booking_dates')->onDelete('cascade');
            $table->foreignId('container_id')->constrained('containers')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_date_containers');
    }
};
