<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $user = auth()->user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json(['message' => 'Кошик порожній'], 400);
        }

        $request->validate([
            'payment_method' => 'required|string|max:50',
            'place' => 'required|string|max:50',
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => $request->input('payment_method'),
            'place' => $request->input('place'),
            'shipping_status' => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) {
                return response()->json(['message' => 'Товар не знайдено'], 400);
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->product_id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('profile.profile')->with('success', 'Замовлення створено успішно!');
    }

    public function orderHistory()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->get();

        return view('order.history', compact('orders'));
    }

}
