<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function show($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->with('subcategories')->firstOrFail();

        if ($category->subcategories->isNotEmpty()) {
            return view('category', compact('category'));
        }

        $query = Product::where('category_id', $category->id);

        $this->applyFilters($query, $request);

        $products = $query->select('id', 'name', 'slug', 'description', 'price', 'stock', 'image')
            ->paginate(12)
            ->appends($request->query());

        return view('category', compact('category', 'products'));
    }

    private function applyFilters($query, Request $request)
    {
        // Фильтр по минимальной цене
        $priceMin = $request->input('price_min');
        if ($request->has('price_min') && is_numeric($priceMin) && $priceMin >= 0) {
            $query->where('price', '>=', (float) $priceMin);
        }

        // Фильтр по максимальной цене
        $priceMax = $request->input('price_max');
        if ($request->has('price_max') && is_numeric($priceMax) && $priceMax >= 0) {
            $query->where('price', '<=', (float) $priceMax);
        }

        // Фильтр по наличию
        if ($request->has('in_stock') && $request->input('in_stock') === '1') {
            $query->where('stock', '>', 0);
        }

        // Безопасная сортировка
        $allowedSorts = ['created_at', 'price'];
        $sort = in_array($request->input('sort'), $allowedSorts) ? $request->input('sort') : 'created_at';
        
        $allowedDirections = ['asc', 'desc'];
        $direction = in_array(strtolower($request->input('direction')), $allowedDirections) ? strtolower($request->input('direction')) : 'desc';

        $query->orderBy($sort, $direction);
    }

    public function catalog()
    {
        $categories = Category::orderBy('name')->get();
        return view('catalog', compact('categories'));
    }
}