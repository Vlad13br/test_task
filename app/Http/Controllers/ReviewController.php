<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Watcher;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
            'watcher_id' => 'required|exists:watchers,id',
        ]);

        $user = auth()->user();
        $watcherId = $request->watcher_id;

        $existingReview = Review::where('user_id', $user->id)
            ->where('watcher_id', $watcherId)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Ви вже залишили відгук для цього товару.');
        }

        Review::create([
            'user_id' => $user->id,
            'watcher_id' => $watcherId,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->route('watch.show', ['id' => $watcherId])
            ->with('success', 'Ваш відгук успішно додано.');
    }

}
