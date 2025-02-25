@extends('layouts.app')

@section('content')
<h1>{{ $category->name }}</h1>

@if($products->count())
    <div>
        @foreach($products as $product)
            <div>
                <h3><a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a></h3>
                <p>Цена: {{ $product->price }} ₽</p>
                <p>В наличии: {{ $product->stock }}</p>
            </div>
        @endforeach
    </div>

    {{ $products->links() }}
@else
    <p>В этой категории пока нет товаров.</p>
@endif
@endsection
