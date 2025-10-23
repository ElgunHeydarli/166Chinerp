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
        Schema::create('order_item_railway_status_changes', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->unsignedBigInteger('order_item_railway_bill_id');

            $table->foreign('order_item_railway_bill_id', 'fk_railway_bill')
                ->references('id')
                ->on('order_item_railway_bills')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_railway_status_changes');
    }
};
