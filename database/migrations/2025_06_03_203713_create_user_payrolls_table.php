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
        Schema::create('user_payrolls', function (Blueprint $table) {
            $table->id();
            $table->decimal('cash_payment')->nullable();
            $table->decimal('bank_payment')->nullable();
            $table->decimal('government_payment')->nullable();
            $table->decimal('withholding_payment')->nullable();
            $table->decimal('bonus')->nullable();
            $table->date('last_payment_date');
            $table->boolean('status')->default(0);
            $table->string('currency');
            $table->string('bank_file')->nullable();
            $table->string('cash_file')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payrolls');
    }
};
