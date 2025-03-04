<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->decimal('rating', 3, 2);
            $table->text('review_text')->nullable();
            $table->timestamp('review_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('watcher_id')->constrained('watchers')->onDelete('cascade');

            $table->unique(['user_id', 'watcher_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
