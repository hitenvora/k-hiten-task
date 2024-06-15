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
            $table->string('user_id')->after('admin_client_id')->nullable();
            $table->string('is_delivery')->after('return_order')->nullable()->default(0)->comment("0=processing, 1=delivered, 2=in-transit, 3=cancelled, 4=accepted,5=undelivered");
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
