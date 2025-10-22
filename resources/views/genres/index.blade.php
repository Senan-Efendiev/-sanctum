@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Список жанров</h1>
            <a href="{{ route('genres.create') }}" class="btn btn-success">Добавить жанр</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Количество игр</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($genres as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>{{ $genre->games->count() }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('genres.show', $genre->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                                <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить этот жанр?')">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
