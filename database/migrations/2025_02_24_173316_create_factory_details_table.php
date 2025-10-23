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
        Schema::create('factory_details', function (Blueprint $table) {
            $table->id();
            $table->string('cube')->nullable();
            $table->string('delivery_point')->nullable();
            $table->integer('box_count')->default(0);
            $table->integer('palette_count')->default(0);
            $table->string('vin_code')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('product_type_id')->nullable()->constrained('product_types')->onDelete('set null');
            $table->foreignId('order_factory_id')->constrained('order_factories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factory_details');
    }
};
