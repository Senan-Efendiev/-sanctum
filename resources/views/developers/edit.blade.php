@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Редактировать разработчика: {{ $developer->name }}</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('developers.update', $developer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название *</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name', $developer->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="founded" class="form-label">Дата основания *</label>
                        <input type="date" class="form-control" id="founded" name="founded"
                               value="{{ old('founded', $developer->founded ? $developer->founded->format('Y-m-d') : '') }}" required>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Обновить</button>
                <a href="{{ route('developers.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
@endsection
