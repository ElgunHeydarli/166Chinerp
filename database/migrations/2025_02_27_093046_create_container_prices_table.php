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
        Schema::create('container_prices', function (Blueprint $table) {
            $table->id();
            $table->decimal('price')->nullable();
            $table->foreignId('container_type_id')->constrained('container_types')->onDelete('cascade');
            $table->foreignId('station_id')->nullable()->constrained('stations')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_prices');
    }
};
