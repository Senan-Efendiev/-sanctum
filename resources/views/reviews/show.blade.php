@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Отзыв #{{ $review->id }}</h2>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Игра:</strong>
                            <a href="{{ route('games.show', $review->game_id) }}">
                                {{ $review->game->title }}
                            </a>
                        </p>
                        <p><strong>Пользователь:</strong> {{ $review->user->username }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Рейтинг:</strong>
                            <span class="badge bg-{{ $review->rating >= 7 ? 'success' : ($review->rating >= 4 ? 'warning' : 'danger') }}">
                            {{ $review->rating }}/10
                        </span>
                        </p>
                        <p><strong>Дата:</strong> {{ $review->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <h4>Комментарий:</h4>
                    <div class="card">
                        <div class="card-body">
                            {{ $review->comment ?? 'Без комментария' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
