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
        Schema::table('app_order_carts', function (Blueprint $table) {
            $table->string('return_product')->nullable()->after('gst')->default('0');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_order_carts', function (Blueprint $table) {
        });
    }
};
