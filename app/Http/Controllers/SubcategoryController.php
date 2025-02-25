<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function show($categorySlug, $subcategorySlug, Request $request)
    {
        $subcategory = Subcategory::where('slug', $subcategorySlug)
            ->with('category', 'products')
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->firstOrFail();

        $query = $subcategory->products();

        // Применяем фильтры
        $this->applyFilters($query, $request);

        $products = $query->select('id', 'name', 'slug', 'description', 'price', 'stock', 'image')
            ->paginate(12)
            ->appends($request->query());

        return view('subcategory', compact('subcategory', 'products'));
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

        // Фильтр по бренду (если есть)
        $brand = $request->input('brand');
        if ($request->has('brand') && !empty($brand)) {
            $query->where('brand', $brand);
        }

        // Безопасная сортировка
        $allowedSorts = ['created_at', 'price'];
        $sort = in_array($request->input('sort'), $allowedSorts) ? $request->input('sort') : 'created_at';
        
        $allowedDirections = ['asc', 'desc'];
        $direction = in_array(strtolower($request->input('direction')), $allowedDirections) ? strtolower($request->input('direction')) : 'desc';

        $query->orderBy($sort, $direction);
    }
}