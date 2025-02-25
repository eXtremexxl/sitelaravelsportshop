<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; // Добавляем модель товара
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (empty(session('cart'))) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста!');
        }

        return view('checkout');
    }

    public function process(Request $request)
    {
        // Валидация формы
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
        ]);
    
        // Получаем содержимое корзины
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста!');
        }
    
        // Создаем заказ
        $order = Order::create([
            'user_id'       => Auth::id(),
            'customer_name' => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'total'         => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)),
            'status'        => 'pending',
        ]);
    
    
        // Добавляем товары в `order_items`
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
        
            if (!$product) {
                return redirect()->route('cart')->with('error', "Товар не найден.");
            }
        
            if ($product->stock >= $item['quantity']) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
        
                // Уменьшаем количество товара
                $product->stock -= $item['quantity'];
                $product->increment('sales_count', $item['quantity']);
                $product->save();
            } else {
                return redirect()->route('cart')->with('error', "Недостаточно товара: {$product->name}");
            }
        }
        
        
        
    
        // Очищаем корзину
        session()->forget('cart');
    
        return redirect()->route('home')->with('success', 'Ваш заказ успешно оформлен!');
    }
}
