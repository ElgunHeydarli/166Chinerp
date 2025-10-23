<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_item_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable();
            $table->date('arrival_date')->nullable();
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_warehouses');
    }
};
