@extends('layouts.admin')

@section('content')
    <h1>Редактировать подкатегорию</h1>

    <form action="{{ route('admin.subcategories.update', $subcategory) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="name">Название:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $subcategory->name) }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="category_id">Категория:</label><br>
            <select name="category_id" id="category_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="image">Изображение:</label><br>
            @if($subcategory->image)
                <img src="{{ asset('storage/' . $subcategory->image) }}" width="100" alt="{{ $subcategory->name }}" style="margin-bottom: 10px;">
            @else
                <p>Нет изображения</p>
            @endif
            <input type="file" name="image" id="image" style="width: 100%;">
            @error('image')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer;">
            Сохранить
        </button>
        <a href="{{ route('admin.subcategories.index') }}" style="padding: 8px 16px; background: #6c757d; color: white; text-decoration: none; border-radius: 3px; margin-left: 10px;">
            Отмена
        </a>
    </form>
@endsection