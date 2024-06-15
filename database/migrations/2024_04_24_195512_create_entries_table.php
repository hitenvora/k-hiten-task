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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('partie_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('perch_id')->nullable();
            $table->string('credit_debit')->comment('credit=0, debit=1')->nullable();
            $table->string('payment_type')->comment('cash = 0 , check = 1, RTGS = 2')->default('0');
            $table->string('type')->comment("app=0 web=1, admin=2 ")->nullable()->default(0);
            $table->string('check_no')->nullable();
            $table->string('rtgs_no')->nullable();
            $table->string('narration')->nullable();
            $table->string('rupee')->nullable();
            $table->string('bank_id')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};