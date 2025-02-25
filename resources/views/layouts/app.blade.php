<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dream Sport</title>

    <!-- Подключение стилей -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://slater.app/10324/23333.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slide-navbar-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    @yield('head')
</head>

<body class="{{ isset($isHome) && $isHome ? 'homepage' : '' }}">
    <div class="wrapper">
<!-- Навигация -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">DreamSport</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">Корзина</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog') }}">Каталог</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('account') }}">Личный кабинет</a>
                    </li>

                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Админка</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="nav-link logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">Выйти</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Вход</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

        <!-- Контент страницы -->
        <main class="main-content"> <!-- Исправлено: class="main-content" -->
            @yield('content')
        </main>

        <!-- Футер -->
        <footer class="footer">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-column">
                        <h3>О компании</h3>
                        <p>Premium спортивное питание для ваших побед. Только сертифицированные товары от официальных поставщиков.</p>
                    </div>
                    <div class="footer-column">
                        <h3>Контакты</h3>
                        <p><strong>Телефон:</strong> <a href="tel:+79991234567">+7 (908) 248 71-54</a></p>
                        <p><strong>Email:</strong> <a href="mailto:info@sportfit.ru">info@sportfit.ru</a></p>
                        <p><strong>Адрес:</strong> г. Пермь, ул. Фитнеса, 10</p>
                    </div>
                    <div class="footer-column">
                        <h3>Мы в соцсетях</h3>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="fa-brands fa-telegram"></i></a>
                            <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                            <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© 2025 ДимаСоловьев. Все права защищены.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Подключение скриптов -->
<!-- Подключение jQuery перед Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<!-- Подключение других библиотек -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

<!-- Инициализация AOS -->
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
</script>

<!-- Основной скрипт -->
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>