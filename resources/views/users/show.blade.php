@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Профиль пользователя: {{ $user->username }}</h2>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> {{ $user->id }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Зарегистрирован:</strong> {{ $user->created_at->format('d.m.Y') }}</p>
                        <p><strong>Всего отзывов:</strong> {{ $user->reviews->count() }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h4>Последние отзывы:</h4>
                    @if($user->reviews->count() > 0)
                        <div class="list-group">
                            @foreach($user->reviews->take(5) as $review)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <strong>
                                            <a href="{{ route('games.show', $review->game_id) }}">
                                                {{ $review->game->title }}
                                            </a>
                                        </strong>
                                        <span class="badge bg-{{ $review->rating >= 7 ? 'success' : ($review->rating >= 4 ? 'warning' : 'danger') }}">
                                    {{ $review->rating }}/10
                                </span>
                                    </div>
                                    @if($review->comment)
                                        <p class="mb-1 mt-2">{{ Str::limit($review->comment, 100) }}</p>
                                    @endif
                                    <small class="text-muted">{{ $review->created_at->format('d.m.Y H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">Пользователь пока не оставил ни одного отзыва</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
