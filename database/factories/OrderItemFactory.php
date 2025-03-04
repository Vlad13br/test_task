<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Watcher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'watcher_id' => Watcher::factory(),
            'quantity' => fake()->numberBetween(1, 5),
            'price' => fake()->randomFloat(2, 50, 1000),
        ];
    }
}
