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
        Schema::table('product_detail', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('size_id')->constrained('size');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('like_id')->constrained('like');
            $table->foreignId('color_id')->constrained('color');
            $table->foreignId('image_id')->constrained('image');
            $table->foreignId('information_id')->constrained('information');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_detail', function (Blueprint $table) {
            //
        });
    }
};
