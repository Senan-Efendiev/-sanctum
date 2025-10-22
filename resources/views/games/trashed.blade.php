@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Корзина удаленных игр</h1>
            <a href="{{ route('games.index') }}" class="btn btn-primary">
                Вернуться к списку
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                <tr>
                    <th>Название</th>
                    <th>Удалена</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($games as $game)
                    <tr>
                        <td>{{ $game->title }}</td>
                        <td>{{ $game->deleted_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('games.restore', $game->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Восстановить
                                    </button>
                                </form>
                                <form action="{{ route('games.force-delete', $game->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Удалить навсегда?')">
                                        Удалить навсегда
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Корзина пуста</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $games->links() }}
        </div>
    </div>
@endsection
