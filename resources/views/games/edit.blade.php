@extends('layouts.app')

@section('title', 'Редактировать игру')

@section('content')
    <div class="container">
        <h1 class="mb-4">Редактирование игры: {{ $game->title }}</h1>

        <form action="{{ route('games.update', $game->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Название игры *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $game->title) }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="release_date" class="form-label">Дата выхода *</label>
                        <input type="date" class="form-control @error('release_date') is-invalid @enderror"
                               id="release_date" name="release_date"
                               value="{{ old('release_date', $game->release_date->format('Y-m-d')) }}" required>
                        @error('release_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="platform" class="form-label">Платформа *</label>
                        <input type="text" class="form-control @error('platform') is-invalid @enderror"
                               id="platform" name="platform" value="{{ old('platform', $game->platform) }}" required>
                        @error('platform')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="developer_id" class="form-label">Разработчик *</label>
                        <select class="form-select @error('developer_id') is-invalid @enderror"
                                id="developer_id" name="developer_id" required>
                            <option value="">Выберите разработчика</option>
                            @foreach($developers as $developer)
                                <option value="{{ $developer->id }}"
                                    {{ old('developer_id', $game->developer_id) == $developer->id ? 'selected' : '' }}>
                                    {{ $developer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('developer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="genre_id" class="form-label">Основной жанр *</label>
                        <select class="form-select @error('genre_id') is-invalid @enderror"
                                id="genre_id" name="genre_id" required>
                            <option value="">Выберите жанр</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ old('genre_id', $game->genre_id) == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('genre_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Дополнительные жанры</label>
                        <div class="border p-2 rounded">
                            @foreach($genres as $genre)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           id="genre-{{ $genre->id }}" name="genres[]"
                                           value="{{ $genre->id }}"
                                        {{ in_array($genre->id, old('genres', $game->genres->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genre-{{ $genre->id }}">
                                        {{ $genre->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Обновить</button>
                <a href="{{ route('games.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
@endsection
