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
        Schema::create('perch_parties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('mobail_number')->nullable();
            $table->string('mail')->nullable();
            $table->string('address')->nullable();
            $table->string('products')->nullable();
            $table->string('state')->nullable();
            $table->string('citie')->nullable();
            $table->string('zip_cod')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perch_parties');
    }
};
