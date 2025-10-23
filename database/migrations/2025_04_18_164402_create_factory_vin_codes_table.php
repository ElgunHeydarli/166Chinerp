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
        Schema::create('factory_vin_codes', function (Blueprint $table) {
            $table->id();
            $table->string('vin_code')->nullable();
            $table->foreignId('order_factory_id')->constrained('order_factories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factory_vin_codes');
    }
};
