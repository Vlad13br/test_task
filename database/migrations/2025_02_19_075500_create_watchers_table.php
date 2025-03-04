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
        Schema::create('watchers', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 255);
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->string('material', 50)->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('rating_count')->default(0);
            $table->string('brand', 50)->nullable();
            $table->integer('stock')->default(0);
            $table->text('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchers');
    }
};
