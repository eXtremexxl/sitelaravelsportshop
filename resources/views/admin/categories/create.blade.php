@extends('layouts.admin')

@section('content')
<h1>Добавить категорию</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Название:</label>
    <input type="text" name="name" required>
    
    <label>Slug:</label>
    <input type="text" name="slug" required>

    <label>Изображение:</label>
    <input type="file" name="image">

    <button type="submit">Создать</button>
</form>

@endsection
