@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">{{ $game->title }}</h2>
                    <div class="btn-group">
                        <a href="{{ route('games.edit', $game->id) }}" class="btn btn-light">Редактировать</a>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Удалить эту игру?')">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> {{ $game->id }}</p>
                        <p><strong>Дата выхода:</strong> {{ $game->release_date->format('d.m.Y') }}</p>
                        <p><strong>Платформа:</strong> {{ $game->platform }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Разработчик:</strong>
                            <a href="{{ route('developers.show', $game->developer->id) }}">
                                {{ $game->developer->name }}
                            </a>
                        </p>
                        <p><strong>Основной жанр:</strong> {{ $game->genre->name }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h4>Дополнительные жанры:</h4>
                    @if($game->genres->count() > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($game->genres as $genre)
                                <span class="badge bg-secondary">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                    @else
                        <p>Нет дополнительных жанров</p>
                    @endif
                </div>
                <div class="mt-4">
                    <h4>Отзывы:</h4>
                    @if($game->reviews->count() > 0)
                        <div class="list-group">
                            @foreach($game->reviews as $review)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $review->user->username ?? 'Аноним' }}</strong>
                                        <span class="badge bg-primary">{{ $review->rating }}/10</span>
                                    </div>
                                    <p class="mb-1">{{ $review->comment }}</p>
                                    <small class="text-muted">{{ $review->created_at->format('d.m.Y H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">Пока нет отзывов</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
