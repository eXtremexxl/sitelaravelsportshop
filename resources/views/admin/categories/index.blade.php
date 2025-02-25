@extends('layouts.admin')

@section('content')
<h1>📂 Управление категориями</h1>
<a href="{{ route('admin.categories.create') }}" style="padding: 8px 16px; background: #28a745; color: white; text-decoration: none; border-radius: 3px; display: inline-block; margin-bottom: 10px;">
    ➕ Добавить категорию
</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
    <tr style="background: #f4f4f4; text-align: left;">
        <th style="border: 1px solid #ddd; padding: 8px;">ID</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Название</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Изображение</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Действия</th>
    </tr>
    @foreach($categories as $category)
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $category->id }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $category->name }}</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" width="50" style="border-radius: 5px;">
            @else
                <span style="color: gray;">Нет изображения</span>
            @endif
        </td>
        <td style="border: 1px solid #ddd; padding: 8px;">
            <a href="{{ route('admin.categories.edit', $category) }}" style="color: #007bff; text-decoration: none; margin-right: 10px;">✏️ Редактировать</a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Удалить категорию?')" style="background: none; border: none; color: red; cursor: pointer; font-size: 16px;">
                    🗑️ Удалить
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
