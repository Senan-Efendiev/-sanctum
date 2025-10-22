@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Жанр: {{ $genre->name }}</h2>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <h4>Игры в этом жанре:</h4>
                    @if($genre->games->count() > 0)
                        <div class="list-group">
                            @foreach($genre->games as $game)
                                <a href="{{ route('games.show', $game->id) }}"
                                   class="list-group-item list-group-item-action">
                                    {{ $game->title }}
                                    <span class="badge bg-secondary float-end">
                                {{ $game->release_date->format('Y') }}
                            </span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">Нет игр в этом жанре</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
