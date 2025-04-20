<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        $user = auth()->user();
        $productId = $request->product_id;

        $existingReview = Review::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Ви вже залишили відгук для цього товару.');
        }

        Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->route('watch.show', ['id' => $productId])
            ->with('success', 'Ваш відгук успішно додано.');
    }

}
