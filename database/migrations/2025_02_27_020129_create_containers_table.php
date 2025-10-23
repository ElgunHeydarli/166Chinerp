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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->enum('purchase_type', ['purchase', 'rent'])->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('count')->nullable();
            $table->decimal('price')->nullable();
            $table->string('price_currency')->nullable();
            $table->string('weight')->nullable();
            $table->string('volume')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->date('last_payment_date')->nullable();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('set null');
            $table->foreignId('container_type_id')->nullable()->constrained('container_types')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};
