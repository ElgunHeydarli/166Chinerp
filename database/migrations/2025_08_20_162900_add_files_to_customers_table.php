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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('contract_number')->nullable();
            $table->string('bill_invoice')->nullable();
            $table->string('handover')->nullable();
            $table->string('price_agreement_protocol')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('contract_number');
            $table->dropColumn('bill_invoice');
            $table->dropColumn('handover');
            $table->dropColumn('price_agreement_protocol');
        });
    }
};
