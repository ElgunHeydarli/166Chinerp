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
        Schema::create('order_services', function (Blueprint $table) {
            $table->id();
            $table->decimal('purchase_price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->date('date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->text('note')->nullable();
            $table->string('document_type')->nullable();
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->foreignId('expense_type_id')->nullable()->constrained('expense_types')->onDelete('set null');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('set null');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_services');
    }
};
