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
        Schema::create('sale', function (Blueprint $table) {
            $table->id();
            $table->string('code_sale');
            $table->integer('value');
            $table->timestamps();
            // $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale');
    }
};
