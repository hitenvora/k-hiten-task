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
        Schema::table('products', function (Blueprint $table) {
            $table->string('price_1')->default('0')->after('web');
            $table->string('price_2')->default('0')->after('price_1');
            $table->string('price_3')->default('0')->after('price_2');
            $table->string('price_4')->default('0')->after('price_3');
            $table->string('kg_1')->default('0')->after('price_4');
            $table->string('kg_2')->default('0')->after('kg_1');
            $table->string('kg_3')->default('0')->after('kg_2');
            $table->string('kg_4')->default('0')->after('kg_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
