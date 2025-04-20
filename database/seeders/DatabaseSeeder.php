<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(20)->create();

        $categories = collect(['watch', 'mobile', 'laptop'])->map(function ($name) {
            return Category::factory()->create(['name' => $name]);
        });

        Product::factory(40)->create()->each(function ($product) {
            $reviews = Review::factory(rand(1, 10))->create(['product_id' => $product->product_id]);
            $product->update([
                'rating_count' => $reviews->count(),
                'rating' => $reviews->avg('rating') ?? 0,
            ]);
        });
        Order::factory(10)->create();
        OrderItem::factory(30)->create();
    }
}
