@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">

<div class="product-container">
    <div class="product-header">
        <h1 class="product-title">{{ $product->name }}</h1>
    </div>

    <div class="product-content">
        <div class="product-image-wrapper">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}" loading="lazy">
            @else
                <div class="no-image">Нет изображения</div>
            @endif
        </div>

        <div class="product-details">
            <p class="product-description">{{ $product->description }}</p>
            
            <div class="product-info">
                <p class="product-price">{{ $product->price }} ₽</p>
                <p class="product-stock {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                    {{ $product->stock > 0 ? "В наличии: $product->stock шт." : 'Нет в наличии' }}
                </p>
            </div>

            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="product-form">
                    @csrf
                    <button type="submit" class="product-button">Добавить в корзину</button>
                </form>
            @else
                <p class="out-of-stock-message">Товар временно недоступен</p>
            @endif
        </div>
    </div>
</div>
@endsection