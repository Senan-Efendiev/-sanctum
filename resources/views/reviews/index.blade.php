@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Список отзывов</h1>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Игра</th>
                    <th>Пользователь</th>
                    <th>Рейтинг</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>
                            <a href="{{ route('games.show', $review->game_id) }}">
                                {{ $review->game->title }}
                            </a>
                        </td>
                        <td>{{ $review->user->username }}</td>
                        <td>
                        <span class="badge bg-{{ $review->rating >= 7 ? 'success' : ($review->rating >= 4 ? 'warning' : 'danger') }}">
                            {{ $review->rating }}/10
                        </span>
                        </td>
                        <td>{{ $review->created_at->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
