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
        Schema::create('manufacturings', function (Blueprint $table) {
            $table->id();
            $table->string('product_one_id')->nullable();
            $table->string('product_two_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('type')->comment('Conversion One to Many = 1,Conversion One to Many = 0')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufacturings');
    }
};
