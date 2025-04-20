<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('category')) {
            $query->whereIn('category_id', $request->category);
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

        $categories = Category::all();

        return view('welcome', compact('products', 'categories'));
    }



    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)->orderBy('review_date', 'desc')->get();

        return view('product-page', compact('product', 'reviews'));
    }

    public function destroyReview($review_id)
    {
        $review = Review::findOrFail($review_id);

        if (auth()->user()->role !== 'admin' && auth()->id() !== $review->user_id) {
            return redirect('/')->with('error', 'У вас немає прав для видалення цього відгуку.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Відгук успішно видалено.');
    }

}
