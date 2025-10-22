@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Список разработчиков</h1>
            <a href="{{ route('developers.create') }}" class="btn btn-success">Добавить разработчика</a>
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
                    <th>Основан</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($developers as $developer)
                    <tr>
                        <td>{{ $developer->id }}</td>
                        <td>{{ $developer->name }}</td>
                        <td>{{ $developer->founded ? $developer->founded->format('d.m.Y') : 'Не указано' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('developers.show', $developer->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                                <a href="{{ route('developers.edit', $developer->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                                <form action="{{ route('developers.destroy', $developer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить этого разработчика?')">Удалить</button>
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
