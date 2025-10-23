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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('percent')->default(0);
            $table->decimal('remainder')->default(0);
            $table->date('first_date')->nullable();
            $table->date('last_date')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('payment_type_id')->nullable()->constrained('payment_types')->onDelete('set null');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
