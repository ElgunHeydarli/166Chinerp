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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id');
            $table->enum('customer_type', ['physical', 'legal']);
            $table->string('vendor_name')->nullable();
            $table->string('chinese_name')->nullable();
            $table->string('role')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('voen')->nullable();
            $table->string('legal_address')->nullable();
            $table->string('factical_address')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_voen')->nullable();
            $table->string('code')->nullable();
            $table->string('account')->nullable();
            $table->string('agent_account')->nullable();
            $table->string('swift')->nullable();
            $table->string('director')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
