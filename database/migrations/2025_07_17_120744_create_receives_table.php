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
        Schema::create('receives', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->string('service_name')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('vat')->nullable();
            $table->decimal('total_price')->nullable();
            $table->decimal('initial_payment')->nullable();
            $table->decimal('remainder')->nullable();
            $table->enum('status', ['pending', 'paid', 'not_paid'])->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receives');
    }
};
