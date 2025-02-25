@extends('layouts.admin')

@section('content')
    <h1>Добавить подкатегорию</h1>
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Название:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Категория:</label>
            <select name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Изображение:</label>
            <input type="file" name="image">
        </div>
        <button type="submit">Сохранить</button>
    </form>
@endsection