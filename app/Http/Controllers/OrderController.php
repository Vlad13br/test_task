<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Watcher;
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
            $watcher = Watcher::find($productId);
            if (!$watcher) {
                return response()->json(['message' => 'Товар не знайдено'], 400);
            }

            OrderItem::create([
                'order_id' => $order->id,
                'watcher_id' => $watcher->id,
                'quantity' => $item['quantity'],
                'price' => $watcher->price,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('profile.profile')->with('success', 'Замовлення створено успішно!');
    }

    public function orderHistory()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
            ->with('orderItems.watcher')
            ->get();

        return view('order.history', compact('orders'));
    }

    public function index()
    {
        $orders = Order::with('orderItems.watcher')
        ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'shipping_status' => 'required|string',
            'payment_method' => 'nullable|string',
        ]);

        $order->update([
            'shipping_status' => $request->shipping_status,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('admin.orders')->with('success', 'Замовлення оновлено.');
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Замовлення видалено.');
    }

}
