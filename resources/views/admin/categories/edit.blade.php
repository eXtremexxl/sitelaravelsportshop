@extends('layouts.admin')

@section('content')
<h1>Редактировать категорию</h1>

<form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Название:</label>
    <input type="text" name="name" value="{{ $category->name }}" required>

    <label>Slug:</label>
    <input type="text" name="slug" value="{{ $category->slug }}" required>

    <label>Изображение:</label>
    <input type="file" name="image">

    @if($category->image)
        <div>
            <p>Текущее изображение:</p>
            <img src="{{ asset('storage/' . $category->image) }}" width="150">
        </div>
    @endif

    <button type="submit">Сохранить</button>
</form>

@endsection
