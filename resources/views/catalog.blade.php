@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">

<div class="catalog-container">
    <h1 class="catalog-title">
        <i class="catalog-icon">📋</i> Каталог товаров
    </h1>

    <div class="catalog-grid">
        @forelse($categories as $category)
            <div class="catalog-card">
                <a href="{{ route('category', $category->slug) }}" class="catalog-card-link">
                    <div class="catalog-image-wrapper">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="catalog-image">
                    </div>
                    <h3 class="catalog-name">{{ $category->name }}</h3>
                </a>
                <p class="catalog-description">{{ Str::limit($category->description, 100) }}</p>
                <a href="{{ route('category', $category->slug) }}" class="catalog-button">Смотреть</a>
            </div>
        @empty
            <div class="empty-catalog">
                <p>Каталог пока пуст 😔</p>
            </div>
        @endforelse
    </div>
</div>
@endsection