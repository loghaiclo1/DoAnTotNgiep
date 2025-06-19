<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="sidebar"> <!-- menu bên trái --> </div>
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>
