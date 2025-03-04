<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'rating',
        'review_text',
        'watcher_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function watcher()
    {
        return $this->belongsTo(Watcher::class);
    }
}
