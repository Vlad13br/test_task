<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_start' => now(),
            'order_end' => fake()->dateTimeBetween('+1 days', '+1 week'),
            'place'=>fake()->streetAddress(),
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'cash_on_delivery']),
            'shipping_status' => 'pending',
            'user_id' => User::factory(),
        ];
    }
}
