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
        Schema::table('app_orders', function (Blueprint $table) {
            $table->string('type')->comment("app=0 web=1, admin=2 ")->nullable()->default(0);
            $table->string('bill_due_date')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->comment("app=0 paid=1, unpaid=2 ,panding=3")->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_orders', function (Blueprint $table) {
            //
        });
    }
};
