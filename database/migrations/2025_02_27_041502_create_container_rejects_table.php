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
        Schema::create('container_rejects', function (Blueprint $table) {
            $table->id();
            $table->text('note')->nullable();
            $table->foreignId('container_id')->constrained('containers')->onDelete('cascade');
            $table->foreignId('reject_reason_id')->constrained('reject_reasons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_rejects');
    }
};
