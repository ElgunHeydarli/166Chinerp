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
    Schema::create('accounts', function (Blueprint $table) {
        $table->id();
        $table->string('number');            // Hesabın nömrəsi
        $table->string('title');             // Hesabın adı
        $table->string('type');              // Hesab növü (məs: Öhdəlik)
        $table->string('currency')->default('AZN'); // Valyuta (USD, AZN və s.)
        $table->text('note')->nullable();    // Qeyd
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
