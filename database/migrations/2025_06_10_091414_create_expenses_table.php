<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('log_id')->nullable();
            $table->decimal('total_price', 15, 2)->default(0);
            $table->decimal('pay_price', 15, 2)->default(0);
            $table->decimal('remainder', 15, 2)->default(0);
            $table->date('last_payment_date')->nullable();
            $table->string('currency', 10)->nullable();
            $table->enum('expense_type', ['one-time', 'recurring'])->nullable();
            $table->string('factory')->nullable();
            $table->text('note')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('set null');
            $table->foreignId('expense_category_id')->nullable()->constrained('expense_categories')->onDelete('set null');
            $table->foreignId('expense_sub_category_id')->nullable()->constrained('expense_sub_categories')->onDelete('set null');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
}

