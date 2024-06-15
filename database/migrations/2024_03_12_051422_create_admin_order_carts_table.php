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
        Schema::create('admin_order_carts', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('cart_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_quntity')->nullable();
            $table->string('taxes')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_order_carts');
    }
};
