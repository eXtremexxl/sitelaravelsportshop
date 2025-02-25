<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Валидация изображения
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public'); // Сохранение в storage/app/public/categories
            $data['image'] = $path;
        }
    
        Category::create($data);
    
        return redirect()->route('admin.categories.index')->with('success', 'Категория добавлена.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Валидация изображения
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            // Удаление старого изображения, если есть
            if ($category->image) {
                \Storage::disk('public')->delete($category->image);
            }
    
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = $path;
        }
    
        $category->update($data);
    
        return redirect()->route('admin.categories.index')->with('success', 'Категория обновлена.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Категория удалена.');
    }
}
