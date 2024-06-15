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
        Schema::create('profite_and_losses', function (Blueprint $table) {
            $table->id();
            $table->string('amount')->nullable();
            $table->string('profilt_lose')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profite_and_losses');
    }
};
