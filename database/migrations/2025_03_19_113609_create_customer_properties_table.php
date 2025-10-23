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
        Schema::create('customer_properties', function (Blueprint $table) {
            $table->id();
            $table->string('voen')->nullable();
            $table->string('legal_address', 500)->nullable();
            $table->string('factical_address', 500)->nullable();
            $table->string('bank_voen')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('code')->nullable();
            $table->string('account')->nullable();
            $table->string('agent_account')->nullable();
            $table->string('swift')->nullable();
            $table->string('director')->nullable();
            $table->foreignId('sector_id')->nullable()->constrained('sectors')->onDelete('set null');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_properties');
    }
};
