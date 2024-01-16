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
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->float('rating',2,2);
            $table->timestamp('deleted_at');
            $table->timestamps();
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('product_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
