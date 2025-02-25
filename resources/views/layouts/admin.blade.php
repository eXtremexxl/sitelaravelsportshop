<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Админка')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @yield('content')
</body>
</html>
