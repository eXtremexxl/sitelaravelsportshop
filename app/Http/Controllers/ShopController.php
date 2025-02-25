<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at', 'desc')->take(10)->get();
        $bestSellers = Product::orderBy('sales_count', 'desc')->take(4)->get(); // Загружаем хиты продаж

        return view('index', compact('products', 'bestSellers'))->with('isHome', true);
    }

    public function category($slug) {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        if ($products->isEmpty()) {
            return redirect()->route('index')->with('error', 'В этой категории пока нет товаров.');
        }

        return view('category', compact('category', 'products'));
    }

    public function product($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product', compact('product'));
    }

    public function cart() {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function checkout() {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста!');
        }
        return view('checkout', compact('cart'));
    }

    public function account() {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Вам нужно войти в аккаунт.');
        }

        $user = Auth::user();
        return view('account', compact('user'));
    }
}
