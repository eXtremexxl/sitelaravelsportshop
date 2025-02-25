@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">

<div class="account-container">
    <div class="account-header">
        <h1 class="account-title">Личный кабинет</h1>
    </div>

    <div class="account-content">
        <div class="account-info">
            <h2 class="section-title">Ваши данные</h2>
            <div class="info-item">
                <span class="info-label">Имя:</span>
                <span class="info-value">{{ auth()->user()->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ auth()->user()->email }}</span>
            </div>
        </div>

        <div class="account-actions">
            <a href="{{ route('orders') }}" class="account-button">Мои заказы</a>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="account-button logout">Выйти</button>
            </form>
        </div>
    </div>
</div>
@endsection