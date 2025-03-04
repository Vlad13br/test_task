<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'watcher_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function watcher()
    {
        return $this->belongsTo(Watcher::class, 'watcher_id');
    }
}

