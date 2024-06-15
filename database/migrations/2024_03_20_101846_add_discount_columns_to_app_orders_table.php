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
            $table->string('admin_client_id')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_in_percentage')->nullable();
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