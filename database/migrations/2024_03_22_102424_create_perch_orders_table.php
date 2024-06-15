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
        Schema::create('perch_orders', function (Blueprint $table) {
            $table->id();
            $table->string('partie_id')->nullable();
            $table->string('discount_in_percentage')->nullable();
            $table->string('discount')->nullable();
            $table->string('total_text')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->comment("paid=1, unpaid=2 ,panding=3")->nullable()->default(3);
            $table->string('bill_due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perch_orders');
    }
};
