<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Watcher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory(20)->create();
        Watcher::factory(40)->create()->each(function ($watch) {
            $reviews = Review::factory(rand(1, 10))->create(['watcher_id' => $watch->id]);
            $watch->update([
                'rating_count' => $reviews->count(),
                'rating' => $reviews->count() > 0 ? $reviews->avg('rating') : null,
            ]);
        });
        Order::factory(10)->create();
        OrderItem::factory(10)->create();
    }
}
