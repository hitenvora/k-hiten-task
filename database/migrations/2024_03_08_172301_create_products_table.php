<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('product_name')->nullable();
			$table->text('description')->nullable();
			$table->string('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('category')->nullable();
			$table->string('sub_category')->nullable();
			$table->string('per_gram_price')->nullable();
			$table->string('per_kg_price')->nullable();
			$table->string('image')->nullable();
			$table->string('barcodenumber')->nullable();
			$table->string('barcode_img')->nullable();
			$table->string('gst')->nullable();
			$table->string('discount')->nullable();
			$table->string('firm_id')->nullable();
			$table->string('status')->nullable()->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
