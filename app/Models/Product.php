<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $table = 'products';
    protected $fillable = [
        'product_name', 'price', 'description', 'category_id', 'rating', 'rating_count', 'brand', 'stock', 'image_url'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

