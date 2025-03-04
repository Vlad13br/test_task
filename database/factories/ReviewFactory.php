<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Watcher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'rating' => fake()->randomFloat(2, 1, 5),
            'review_text' => fake()->sentence(),
            'review_date' => now(),
            'user_id' => User::factory(),
            'watcher_id' => Watcher::factory(),
        ];
    }
}
