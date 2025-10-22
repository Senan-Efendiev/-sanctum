@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Список пользователей</h1>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                    <th>Количество отзывов</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->reviews_count }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">Профиль</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
