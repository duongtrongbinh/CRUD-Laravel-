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
        Schema::create('orderdetail', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->string('color');
            $table->string('size');
            $table->integer('sale');
            $table->timestamps();
            // $table->unsignedBigInteger('order_id');
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('order_id')->references('id')->on('order');
            // $table->foreign('product_id')->references('id')->on('product');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetail');
    }
};
