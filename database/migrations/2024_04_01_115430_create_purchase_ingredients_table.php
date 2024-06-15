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
        Schema::create('purchase_ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('orders_id')->nullable();
            $table->string('ingredient_id')->nullable();
            $table->string('ingredient_price')->nullable();
            $table->string('ingredient_quntity')->nullable();
            $table->string('sub_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_ingredients');
    }
};
