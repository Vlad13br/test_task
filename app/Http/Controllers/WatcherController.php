<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Watcher;
use Illuminate\Http\Request;

class WatcherController extends Controller
{
    public function index(Request $request)
    {
        $query = Watcher::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
            }
        }

        $products = $query->paginate(15)->appends($request->query());

        return view('welcome', compact('products'));
    }

    public function show($id)
    {
        $watch = Watcher::findOrFail($id);
        $reviews = Review::where('watcher_id', $id)->orderBy('review_date', 'desc')->get();

        return view('watcher-page', compact('watch', 'reviews'));
    }
}
