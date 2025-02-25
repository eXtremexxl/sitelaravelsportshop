@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="cart-container">
    <h1 class="cart-title">
        <i class="cart-icon">🛒</i> Ваша корзина
    </h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="cart-content">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена за ед.</th>
                        <th>Кол-во</th>
                        <th>Итого</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $item)
                        @php $total += $item['price'] * $item['quantity'] @endphp
                        <tr class="cart-item">
                            <td class="cart-product">
                                <div class="product-image">
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                </div>
                                <div class="product-info">
                                    <span class="product-name">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td class="price">{{ number_format($item['price'], 2) }} ₽</td>
                            <td class="quantity">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="quantity-form">
                                    @csrf
                                    <div class="quantity-control">
                                        <button type="button" class="quantity-btn minus">-</button>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="quantity-input">
                                        <button type="button" class="quantity-btn plus">+</button>
                                    </div>
                                    <button type="submit" class="update-btn">Обновить</button>
                                </form>
                            </td>
                            <td class="subtotal">{{ number_format($item['price'] * $item['quantity'], 2) }} ₽</td>
                            <td class="actions">
                                <a href="{{ route('cart.remove', $id) }}" class="remove-btn" title="Удалить">
                                    <span class="remove-icon">✕</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="summary-details">
                    <h2 class="total">Общая сумма: <span>{{ number_format($total, 2) }} ₽</span></h2>
                </div>
                <div class="summary-actions">
                    <a href="{{ route('checkout') }}" class="checkout-btn">Оформить заказ</a>
                    <a href="{{ route('cart.clear') }}" class="clear-cart-btn">Очистить корзину</a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart-container">
            <p class="empty-cart">Ваша корзина пуста 😔</p>
            <a href="{{ route('catalog') }}" class="continue-shopping-btn">Перейти в каталог</a>
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value);
            if (this.classList.contains('minus') && value > 1) {
                input.value = value - 1;
            } else if (this.classList.contains('plus')) {
                input.value = value + 1;
            }
        });
    });
</script>
@endsection