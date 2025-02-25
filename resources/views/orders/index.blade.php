@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/orders.css') }}">

<div class="orders-container" data-aos="fade-up">
    <div class="orders-header">
        <h1 class="orders-title">Мои заказы</h1>
    </div>

    @if($orders->isEmpty())
        <p class="no-orders">У вас пока нет заказов</p>
    @else
        <div class="orders-list">
            @foreach($orders as $order)
                <div class="order-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="order-header">
                        <h3 class="order-id">Заказ #{{ $order->id }}</h3>
                        <p class="order-date">Дата: {{ $order->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div class="order-items">
                        @foreach($order->items as $item)
                            <div class="order-item">
                                <h4 class="item-name">{{ $item->product->name }}</h4>
                                <p class="item-details">
                                    Количество: {{ $item->quantity }} шт. × {{ $item->price }} ₽ = 
                                    <strong>{{ $item->quantity * $item->price }} ₽</strong>
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="order-footer">
                        <p class="order-total">Итого: <strong>{{ $order->items->sum(fn($item) => $item->quantity * $item->price) }} ₽</strong></p>
                        <p class="order-status">Статус: <span class="status {{ $order->status }}">{{ \App\Models\Order::getStatusName($order->status) }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $orders->links('vendor.pagination.custom') }}
        </div>
    @endif
</div>
@endsection