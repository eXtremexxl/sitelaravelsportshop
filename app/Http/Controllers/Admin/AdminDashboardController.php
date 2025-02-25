<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $products = Product::latest()->limit(5)->get();
        return view('admin.dashboard', compact('products'));
    }
}

