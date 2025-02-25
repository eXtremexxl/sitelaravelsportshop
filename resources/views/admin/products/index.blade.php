@extends('layouts.admin')

@section('content')
<h1>Товары</h1>
<a href="{{ route('admin.products.create') }}">Добавить товар</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>ID</th>
        <th>Фото</th>
        <th>Название</th>
        <th>Категория</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Действия</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="50" alt="{{ $product->name }}">
            @else
                <span>Нет фото</span>
            @endif
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category->name }}</td>
        <td>{{ $product->price }} ₽</td>
        <td>{{ $product->stock }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product) }}">Редактировать</a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Удалить товар?')">Удалить</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
