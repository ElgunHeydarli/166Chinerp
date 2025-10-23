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
        Schema::table('booking_date_containers', function (Blueprint $table) {
            $table->foreignId('container_check_reason_id')->nullable()->constrained('container_check_reasons')->onDelete('set null');
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_date_containers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('container_check_reason_id');
            $table->dropColumn('note');
        });
    }
};
