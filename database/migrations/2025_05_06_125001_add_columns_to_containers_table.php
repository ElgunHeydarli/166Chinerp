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
        Schema::table('containers', function (Blueprint $table) {
            $table->decimal('empty_volume')->nullable();
            $table->decimal('packed_volume')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('containers', function (Blueprint $table) {
            $table->dropColumn('empty_volume');
            $table->dropColumn('packed_volume');
        });
    }
};
