@extends('layouts.admin')

@section('content')
    <h1>Подкатегории</h1>
    <a href="{{ route('admin.subcategories.create') }}" style="padding: 8px 16px; background: #28a745; color: white; text-decoration: none; border-radius: 3px; display: inline-block; margin-bottom: 20px;">
        ➕ Добавить подкатегорию
    </a>

    @if(session('success'))
        <p style="color: green; margin-bottom: 20px;">{{ session('success') }}</p>
    @endif

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f4f4f4; text-align: left;">
                <th style="border: 1px solid #ddd; padding: 8px;">ID</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Название</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Категория</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Изображение</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subcategories as $subcategory)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $subcategory->id }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $subcategory->name }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $subcategory->category->name }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        @if($subcategory->image)
                            <img src="{{ asset('storage/' . $subcategory->image) }}" width="50" alt="{{ $subcategory->name }}">
                        @else
                            <span>Нет изображения</span>
                        @endif
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <a href="{{ route('admin.subcategories.edit', $subcategory) }}" style="color: #007bff; text-decoration: none;">✏️ Редактировать</a>
                        <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" style="display:inline;" onsubmit="return confirm('Удалить подкатегорию?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: red; cursor: pointer; font-size: 16px;">🗑️ Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Подкатегорий пока нет</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection