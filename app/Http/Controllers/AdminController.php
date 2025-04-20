<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function testAdmin()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $user->role = 'admin';
            $user->save();

            return redirect('/')->with('success', 'Ви стали адміном!');
        }

        return redirect('/')->with('error', 'Щось пішло не так!');
    }

    public function createWatcher()
    {
        $categories = Category::all();
        return view('admin.watchers.create', compact('categories'));
    }

    public function storeWatcher(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'material' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:50',
            'stock' => 'required|integer',
            'image_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
        ]);
        $validated['category_id'] = (int) $validated['category_id'];
        Product::create($validated);

        return redirect('/dashboard');
    }

    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('admin.watchers.edit', compact('product'));
    }

    public function updateWatcher(Request $request, $product_id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'material' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:50',
            'stock' => 'required|integer',
            'image_url' => 'nullable|url',
        ]);

        $product = Product::findOrFail($product_id);
        $product->update($validated);

        return redirect('/');
    }

    public function destroyWatcher($watcher_id)
    {
        $watcher = Product::findOrFail($watcher_id);
        $watcher->delete();

        return redirect('/')->with('success', 'Товар успішно видалено.');
    }

    public function destroyReview($review_id)
    {
        $review = Review::findOrFail($review_id);

        if ($review->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Ви не можете видалити цей відгук.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Відгук успішно видалено.');
    }


}
