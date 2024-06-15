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
        Schema::table('perch_orders', function (Blueprint $table) {
            $table->string('payment_type')->comment('cash = 0 , check = 1, RTGS = 2')->default('0');
            $table->string('check_number')->nullable();
            $table->string('rtgs_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perch_orders', function (Blueprint $table) {
            //
        });
    }
};
