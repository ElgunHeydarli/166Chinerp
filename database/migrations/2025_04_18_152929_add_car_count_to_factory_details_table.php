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
        Schema::table('factory_details', function (Blueprint $table) {
            $table->integer('car_count')->nullable()->after('palette_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factory_details', function (Blueprint $table) {
            $table->dropColumn('car_count');
        });
    }
};
