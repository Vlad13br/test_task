<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watcher extends Model
{
    use HasFactory;
    protected $table = 'watchers';
    protected $fillable = [
        'product_name', 'price', 'description', 'material', 'rating', 'rating_count', 'brand', 'stock', 'image_url'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

