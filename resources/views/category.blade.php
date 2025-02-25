@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">

<div class="catalog-container">
    <h1 class="catalog-title">{{ $category->name }}</h1>

    @if ($category->subcategories->isNotEmpty())
        <div class="catalog-grid">
            @foreach ($category->subcategories as $subcategory)
                <a href="{{ route('subcategory.show', [$category->slug, $subcategory->slug]) }}" class="catalog-card" data-aos="fade-up">
                    <div class="catalog-image-wrapper">
                        @if ($subcategory->image)
                            <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" loading="lazy">
                        @else
                            <div class="no-image">Нет изображения</div>
                        @endif
                    </div>
                    <h3 class="catalog-name">{{ $subcategory->name }}</h3>
                    <span class="catalog-button">Перейти</span>
                </a>
            @endforeach
        </div>
    @else
        <!-- Форма фильтров -->
        <form method="GET" class="filter-form">
            <div class="filter-group">
                <label>Цена:</label>
                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="От" min="0">
                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="До" min="0">
            </div>

            <div class="filter-group">
                <label>
                    <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') === '1' ? 'checked' : '' }}>
                    Только в наличии
                </label>
            </div>

            <div class="filter-group">
                <label>Сортировка:</label>
                <select name="sort">
                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>По дате</option>
                    <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>По цене</option>
                </select>
                <select name="direction">
                    <option value="desc" {{ request('direction') === 'desc' ? 'selected' : '' }}>Убывание</option>
                    <option value="asc" {{ request('direction') === 'asc' ? 'selected' : '' }}>Возрастание</option>
                </select>
            </div>

            <button type="submit" class="filter-button">Применить</button>
        </form>

        @if (isset($products) && $products->isNotEmpty())
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card" data-aos="fade-up">
                        <div class="product-image-wrapper">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="no-image">Нет изображения</div>
                            @endif
                        </div>
                        <div class="product-content">
                            <a href="{{ route('product', $product->slug) }}" class="product-link">
                                <h3 class="product-name">{{ $product->name }}</h3>
                            </a>
                            <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                            <div class="product-footer">
                                <p class="product-price">{{ $product->price }} ₽</p>
                                <span class="product-stock {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                    {{ $product->stock > 0 ? 'В наличии' : 'Нет в наличии' }}
                                </span>
                            </div>
                            <a href="{{ route('product', $product->slug) }}" class="product-button">Подробнее</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>
        @else
            <p class="empty-message">В этой категории пока нет товаров</p>
        @endif
    @endif
</div>
@endsection