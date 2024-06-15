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
            $table->string('address_id')->after('is_delivery')->nullable();
            $table->string('ship_to_name')->after('address_id')->nullable();
            $table->string('expected_delivery_date')->after('ship_to_name')->nullable();

    
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
