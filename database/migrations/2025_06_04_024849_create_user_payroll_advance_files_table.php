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
        Schema::create('user_payroll_advance_files', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable();
            $table->foreignId('user_payroll_advance_id')->constrained('user_payroll_advances')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payroll_advance_files');
    }
};
