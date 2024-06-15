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
        Schema::create('stock_in_hands', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('price')->nullable();
            $table->string('qty_in_hand')->nullable();
            $table->string('qty_in_sold')->nullable();
            $table->string('inventry_value')->nullable();
            $table->string('sale_value')->nullable();
            $table->string('avalible_stock')->nullable();
            $table->string('status')->nullable()->comment('available = 0 , notavailable = 1,')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_in_hands');
    }
};
