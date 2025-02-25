@extends('layouts.admin')

@section('content')
<h1>📜 Управление заказами</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table style="width: 100%; border-collapse: collapse; margin-top: 10px; border: 1px solid #ddd; text-align: left;">
    <thead>
        <tr style="background: #f4f4f4; border-bottom: 2px solid #ddd;">
            <th style="padding: 10px; border-right: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border-right: 1px solid #ddd;">Покупатель</th>
            <th style="padding: 10px; border-right: 1px solid #ddd;">Дата</th>
            <th style="padding: 10px; border-right: 1px solid #ddd;">Статус</th>
            <th style="padding: 10px; border-right: 1px solid #ddd;">Товары</th>
            <th style="padding: 10px; border-right: 1px solid #ddd;">Сумма</th>
            <th style="padding: 10px;">Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px; border-right: 1px solid #ddd;">{{ $order->id }}</td>
            <td style="padding: 10px; border-right: 1px solid #ddd;">{{ $order->customer_name }}</td>
            <td style="padding: 10px; border-right: 1px solid #ddd;">{{ $order->created_at->format('d.m.Y H:i') }}</td>
            <td style="padding: 10px; border-right: 1px solid #ddd;">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" style="padding: 5px; border-radius: 4px;">
                        <option value="pending" @selected($order->status == 'pending')>В ожидании</option>
                        <option value="processing" @selected($order->status == 'processing')>Обрабатывается</option>
                        <option value="completed" @selected($order->status == 'completed')>Завершён</option>
                        <option value="canceled" @selected($order->status == 'canceled')>Отменён</option>
                    </select>
                </form>
            </td>
            <td style="padding: 10px; border-right: 1px solid #ddd;">
                @foreach($order->items as $item)
                    {{ $item->product->name }} ({{ $item->quantity }} шт.)<br>
                @endforeach
            </td>
            <td style="padding: 10px; border-right: 1px solid #ddd;"><strong>{{ $order->total }} ₽</strong></td>
            <td style="padding: 10px;">
                <a href="#" style="color: red; text-decoration: none; font-weight: bold;">Удалить</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
