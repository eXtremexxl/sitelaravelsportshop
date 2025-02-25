@extends('layouts.admin')

@section('content')
<h1>Админ-панель</h1>
<p>Добро пожаловать, администратор!</p>

<div style="margin-top: 20px;">
    <a href="{{ route('admin.products.index') }}" style="padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 3px; display: inline-block;">
        📦 Управление товарами
    </a>
    <a href="{{ route('admin.products.create') }}" style="padding: 8px 16px; background: #28a745; color: white; text-decoration: none; border-radius: 3px; display: inline-block; margin-left: 10px;">
        ➕ Добавить товар
    </a>
    <a href="{{ route('admin.categories.index') }}" style="padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 3px; display: inline-block; margin-left: 10px;">
        📂 Управление категориями
    </a>
    <a href="{{ route('admin.subcategories.index') }}" style="padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 3px; display: inline-block; margin-left: 10px;">
        📑 Управление подкатегориями
    </a>
    <div style="margin-top: 20px;">
        <a href="{{ route('admin.orders.index') }}" style="padding: 8px 16px; background: #ff9800; color: white; text-decoration: none; border-radius: 3px;">
            📜 Управление заказами
        </a>
    </div>
</div>

@if(session('success'))
    <p style="color: green; margin-top: 20px;">{{ session('success') }}</p>
@endif

<h2 style="margin-top: 30px;">Последние товары</h2>

<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
    <tr style="background: #f4f4f4; text-align: left;">
        <th style="border: 1px solid #ddd; padding: 8px;">ID</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Фото</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Название</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Цена</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Количество</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Действия</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->id }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="50" alt="{{ $product->name }}">
            @else
                <span>Нет фото</span>
            @endif
        </td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->name }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->price }} ₽</td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->stock }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">
            <a href="{{ route('admin.products.edit', $product) }}" style="color: #007bff; text-decoration: none;">✏️ Редактировать</a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Удалить товар?')" style="background: none; border: none; color: red; cursor: pointer; font-size: 16px;">
                    🗑️ Удалить
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection