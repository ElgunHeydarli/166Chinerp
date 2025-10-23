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
        Schema::create('order_item_railway_bills', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_railway_bills');
    }
};
