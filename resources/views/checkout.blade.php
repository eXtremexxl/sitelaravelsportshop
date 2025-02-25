@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<div class="checkout-container">
    <h1 class="checkout-title">Оформление заказа</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">ФИО:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="address">Адрес доставки:</label>
            <textarea id="address" name="address" required>{{ old('address') }}</textarea>
            @error('address') <span class="error">{{ $message }}</span> @enderror
        </div>

        <h2 class="cart-summary-title">Ваш заказ</h2>
        <div class="cart-summary">
            @foreach(session('cart', []) as $id => $item)
                <div class="cart-item">
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <p><strong>{{ $item['name'] }}</strong></p>
                    <p>{{ $item['quantity'] }} x {{ $item['price'] }} ₽</p>
                </div>
            @endforeach
            <p class="total-price">Итого: <strong>{{ array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], session('cart', []))) }} ₽</strong></p>
        </div>

        <button type="submit" class="checkout-button">Оформить заказ</button>
    </form>
</div>
@endsection
