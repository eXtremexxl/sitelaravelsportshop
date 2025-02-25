<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }
    
    public function store(Request $request)
    {
        // Проверяем, есть ли товары в корзине
        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста!');
        }
    
        // Создаем заказ
        $order = new Order();
        $order->user_id = Auth::id();
        $order->customer_name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->total = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cartItems));
        $order->status = 'pending';
        $order->save();
    
        // Добавляем товары в `order_items`, уменьшаем `stock` и увеличиваем `sales_count`
        foreach ($cartItems as $id => $item) {
            $product = Product::find($id);
            if ($product && $product->stock >= $item['quantity']) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
    
                // Уменьшаем количество товара в наличии
                $product->stock -= $item['quantity'];
    
                // Увеличиваем количество продаж
                $product->increment('sales_count', $item['quantity']);
    
                $product->save();
            } else {
                return redirect()->route('cart')->with('error', "Недостаточно товара: {$product->name}");
            }
        }
    
        // Очищаем корзину после оформления заказа
        session()->forget('cart');
    
        return redirect()->route('orders')->with('success', 'Заказ успешно оформлен!');
    }
    

    public function updateStatus(Request $request, Order $order)
    {
        // Проверяем, что переданный статус допустим
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        // Обновляем статус
        $order->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Статус заказа обновлён!');
    }

    public function adminIndex()
    {
        $orders = Order::with('items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
}
