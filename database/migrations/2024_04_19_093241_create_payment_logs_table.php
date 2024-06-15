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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('perch_id')->nullable();
            $table->string('note')->nullable();
            $table->string('rupee')->nullable();
            $table->string('credit_debit')->comment('credit=0, debit=1')->nullable();
            $table->string('payment_type')->comment('cash = 0 , check = 1, RTGS = 2')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
