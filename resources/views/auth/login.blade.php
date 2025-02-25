@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <!-- Sign Up Form -->
    <div class="signup">
    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf
        <label for="chk" aria-hidden="true">Sign up</label>
        
        <input type="text" name="name" placeholder="Имя" required value="{{ old('username') }}">
        @error('username')
            <span class="error">{{ $message }}</span>
        @enderror

        <input type="email" name="email" placeholder="Почта" required value="{{ old('email') }}">
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror

        <input type="password" name="password" placeholder="Введите пароль" required>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror

        <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" required>
        @error('password_confirmation')
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit" class="btnauth">Зарегистрироваться</button>
    </form>
</div>
    <!-- Login Form -->
    <div class="login">
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <label for="chk" aria-hidden="true">Login</label>
            <input type="email" name="email" placeholder="Почта" required value="{{ old('email') }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="Введите пароль" required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror

            <button type="submit">Войти</button>
        </form>
    </div>
</div>
@endsection