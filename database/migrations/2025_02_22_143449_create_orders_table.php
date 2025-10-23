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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->date('apply_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('product_name')->nullable();
            $table->string('price')->nullable();
            $table->string('price_currency')->nullable();
            $table->string('cube')->nullable();
            $table->string('weight')->nullable();
            $table->string('referrer')->nullable();
            $table->string('loading_point')->nullable();
            $table->text('address')->nullable();
            $table->text('note')->nullable();
            $table->boolean('security_mode')->nullable()->default(1);
            $table->boolean('ready_status')->nullable();
            $table->boolean('stackable')->nullable();
            $table->integer('number_of_places')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('length')->nullable();
            $table->string('msds' )->nullable();
            $table->integer('first_car_count')->nullable();
            $table->integer('second_car_count')->nullable();
            $table->boolean('is_evaluate')->nullable()->default(1);
            $table->boolean('internal_transport')->nullable();
            $table->enum('status', ['draft', 'confirmed', 'execute', 'finished', 'rejected'])->nullable();
            $table->string('order_status')->nullable();
            $table->enum('mix_full', ['mix', 'full', 'automobile'])->nullable();
            $table->decimal('cbm')->nullable();
            $table->foreignId('customs_clearance_id')->nullable()->constrained('customs_clearances')->onDelete('set null');
            $table->foreignId('incoterm_id')->nullable()->constrained('incoterms')->onDelete('set null');
            $table->foreignId('container_type_id')->nullable()->constrained('container_types')->onDelete('set null');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->foreignId('about_booking_date_id')->nullable()->constrained('about_booking_dates')->onDelete('set null');
            $table->foreignId('transportation_type_id')->nullable()->constrained('transportation_types')->onDelete('set null');
            $table->foreignId('transportation_service_id')->nullable()->constrained('transportation_services')->onDelete('set null');
            $table->foreignId('transportation_id')->nullable()->constrained('transportations')->onDelete('set null');
            $table->foreignId('first_car_type_id')->nullable()->constrained('car_types')->onDelete('set null');
            $table->foreignId('second_car_type_id')->nullable()->constrained('car_types')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
