@extends('layouts.app')

@section('title', 'Список игр')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Каталог игр</h1>
        @can('create-games')
            <a href="{{ route('games.create') }}" class="btn btn-success">Добавить игру</a>
        @endcan
    </div>

    <!-- Фильтры -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('games.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search-input" class="form-label visually-hidden">Поиск</label>
                        <input type="text" name="search" id="search-input" class="form-control"
                               placeholder="Поиск..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="platform-select" class="form-label visually-hidden">Платформа</label>
                        <select name="platform" id="platform-select" class="form-select">
                            <option value="">Все платформы</option>
                            @foreach(['PC', 'PS5', 'Xbox', 'Switch'] as $platform)
                                <option value="{{ $platform }}" {{ request('platform') == $platform ? 'selected' : '' }}>
                                    {{ $platform }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="genre-select" class="form-label visually-hidden">Жанр</label>
                        <select name="genre" id="genre-select" class="form-select">
                            <option value="">Все жанры</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Фильтр</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Таблица с играми -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
            <tr>
                <th>Название</th>
                <th>Разработчик</th>
                <th>Жанр</th>
                <th>Дата выхода</th>
                <th>Платформа</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($games as $game)
                <tr>
                    <td>
                        <a href="{{ route('games.show', $game->id) }}" class="text-decoration-none">
                            {{ $game->title }}
                        </a>
                    </td>
                    <td>{{ $game->developer->name }}</td>
                    <td>{{ $game->genre->name }}</td>
                    <td>{{ $game->release_date->format('d.m.Y') }}</td>
                    <td>{{ $game->platform }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('games.show', $game->id) }}" class="btn btn-info">Просмотр</a>
                            @can('edit-games')
                                <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning">Редактировать</a>
                            @endcan
                            @can('delete-games')
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить эту игру?')">Удалить</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Игры не найдены</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Пагинация -->
    <div class="d-flex justify-content-center mt-4">
        {{ $games->appends(request()->query())->links() }}
    </div>
@endsection
