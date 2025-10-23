<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('journal_entries', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('journal_id'); // Qrup ID
        $table->date('operation_date')->nullable();
        $table->string('debit_account_number')->nullable();
        $table->string('debit_account_name')->nullable();
        $table->decimal('debit_amount', 12, 2)->nullable();

        $table->string('credit_account_number')->nullable();
        $table->string('credit_account_name')->nullable();
        $table->decimal('credit_amount', 12, 2)->nullable();

        $table->string('currency')->default('AZN');
        $table->text('description')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
