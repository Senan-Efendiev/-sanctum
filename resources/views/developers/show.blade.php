@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2>Разработчик: {{ $developer->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> {{ $developer->id }}</p>
                        <p><strong>Основан:</strong> {{ $developer->founded ? $developer->founded->format('d.m.Y') : 'Не указано' }}</p>
                    </div>
                </div>

                <h4 class="mt-4">Игры этого разработчика:</h4>
                @if($developer->games->count() > 0)
                    <ul class="list-group">
                        @foreach($developer->games as $game)
                            <li class="list-group-item">
                                <a href="{{ route('games.show', $game->id) }}">{{ $game->title }}</a>
                                <span class="badge bg-secondary">{{ $game->release_date->format('Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-warning">Нет игр этого разработчика</div>
                @endif
            </div>
        </div>
    </div>
@endsection
