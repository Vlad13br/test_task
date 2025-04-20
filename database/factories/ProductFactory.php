<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $category = Category::inRandomOrder()->first();

        if (!$category) {
            throw new \Exception('No categories found. Please seed categories before products.');
        }

        $images = [
            'watch' => [
                'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/s/b/sb06n101-5300.jpg',
                'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/s/o/so29n704.jpg',
                'https://swatch.ua/media/catalog/product/cache/2/thumbnail/301x217/9df78eab33525d08d6e5fb8d27136e95/z/f/zfpsp074.jpg',
            ],
            'mobile' => [
                'https://content1.rozetka.com.ua/goods/images/big/518373112.jpg',
                'https://content2.rozetka.com.ua/goods/images/big/487793279.jpg',
                'https://content.rozetka.com.ua/goods/images/big/473822695.jpg',
            ],
            'laptop' => [
                'https://content1.rozetka.com.ua/goods/images/big/365944650.jpg',
                'https://content1.rozetka.com.ua/goods/images/big/144249716.jpg',
                'https://content2.rozetka.com.ua/goods/images/big/477530350.jpg',
            ],
        ];

        $categoryName = $category->name;

        return [
            'product_name' => fake()->word() . ' Product',
            'price' => fake()->randomFloat(2, 500, 5000),
            'description' => implode(' ', fake()->words(10)),
            'brand' => fake()->company(),
            'stock' => fake()->numberBetween(0, 100),
            'image_url' => fake()->randomElement($images[$categoryName]),
            'category_id' => $category->id,
        ];
    }
}
