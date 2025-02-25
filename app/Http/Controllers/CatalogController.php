<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Фильтр по цене
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        // Фильтр по наличию
        if ($request->has('in_stock') && $request->input('in_stock') === '1') {
            $query->where('stock', '>', 0);
        }


        // Сортировка
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');
        $query->orderBy($sort, $direction);

        $products = $query->paginate(12)->appends($request->query());

        return view('catalog', compact('products'));
    }
}