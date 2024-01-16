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
            $table->foreignId('status_id')->constrained('status');
            $table->string('image_first');
            $table->string('image_first_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_detail', function (Blueprint $table) {
            $table->dropColumn(['image_first_name', 'image_first']);
        });
    }
};
