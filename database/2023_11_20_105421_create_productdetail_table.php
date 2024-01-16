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
        Schema::create('productdetail', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->timestamps();
            // $table->unsignedBigInteger('size_id');
            // $table->unsignedBigInteger('color_id');
            // $table->unsignedBigInteger('product_image_id');
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('size_id')->references('id')->on('size');
            // $table->foreign('color_id')->references('id')->on('color');
            // $table->foreign('product_image_id')->references('id')->on('image_product');
            // $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productdetail');
    }
};
