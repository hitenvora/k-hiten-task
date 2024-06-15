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
        Schema::create('app_orders', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id')->nullable();
            $table->string('total_text')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_contact_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_orders');
    }
};
