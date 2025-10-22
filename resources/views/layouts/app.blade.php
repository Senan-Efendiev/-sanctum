<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Reviews - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .main-content {
            min-height: calc(100vh - 120px);
        }
    </style>
</head>
<body>
<!-- Навигационное меню -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('games.index') }}">Вернуться к играм</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('games.index') }}">Игры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('developers.index') }}">Разработчики</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('genres.index') }}">Жанры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reviews.index') }}">Отзывы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">Пользователи</a>
                </li>
                @auth
                    @if(Auth::user()->email === 'admin@mail.ru')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('games.create') }}">Добавить игру</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Форма аутентификации в навигации -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Выйти
                                </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Основное содержимое -->
<div class="container main-content py-4">
    <!-- Блок для флэш-сообщений -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<!-- Подвал -->
<footer class="bg-light py-3">
    <div class="container text-center">
        <p class="mb-0">© 2025 Игровые отзывы</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
