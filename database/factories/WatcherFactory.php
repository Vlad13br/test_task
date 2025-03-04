<?php

namespace Database\Factories;

use App\Models\Watcher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Watcher>
 */
class WatcherFactory extends Factory
{
    protected $model = Watcher::class;

    public function definition()
    {
        $images = [
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/s/b/sb06n101-5300.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/s/o/so29n704.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfpsp074.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfpsp072.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfpsp071.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfpsp073.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfbnp233.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfpnp158.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfpnp159.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfbnp234.jpg',
            'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/s/o/so29z148.jpg',
            // Додавайте інші посилання на картинки з цього списку за необхідністю
        ];

        return [
            'product_name' => fake()->word() . ' Watch',
            'price' => fake()->randomFloat(2, 500, 5000),
            'description' => implode(' ', fake()->words(10)),
            'material' => fake()->randomElement(['Gold', 'Silver', 'Titanium', 'Plastic']),
            'brand' => fake()->company(),
            'stock' => fake()->numberBetween(0, 100),
            'image_url' => $images[fake()->numberBetween(0, count($images) - 1)], // Вибір випадкового зображення
        ];
    }
}
