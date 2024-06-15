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
        Schema::table('admin_customer', function (Blueprint $table) {
            $table->string('type')->comment('0 for app, 1 for web')->default(0);
            $table->string('cart_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_customer', function (Blueprint $table) {
            //
        });
    }
};
