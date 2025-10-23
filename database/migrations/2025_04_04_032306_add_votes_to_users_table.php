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
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('fin')->nullable();
            $table->string('position')->nullable();
            $table->string('mmc')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->decimal('gross_salary')->nullable();
            $table->decimal('cash')->nullable();
            $table->decimal('bank')->nullable();
            $table->decimal('government_payment')->nullable();
            $table->decimal('net_salary')->nullable();
            $table->string('currency')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('education_id')->nullable()->constrained('education')->onDelete('set null');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('fin');
            $table->dropColumn('position');
            $table->dropColumn('mmc');
            $table->dropColumn('phone');
            $table->dropColumn('gender');
            $table->dropColumn('gross_salary');
            $table->dropColumn('cash');
            $table->dropColumn('bank');
            $table->dropColumn('government_payment');
            $table->dropColumn('net_salary');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('currency');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
};
