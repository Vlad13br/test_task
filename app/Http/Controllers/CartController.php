<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = $request->input('product');

        $cart = session()->get('cart', []);

        if(isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity']++;
        } else {
            $cart[$product['id']] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['image']
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('watcher.index')->with('success', 'Товар додано в кошик');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if(isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('profile.profile');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        return redirect()->route('profile.profile');
    }
}
