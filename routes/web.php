<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello World']);
});

// Маршруты для разработчиков
Route::get('/developers', [DeveloperController::class, 'index']);
Route::get('/developers/{id}', [DeveloperController::class, 'show']);

// Маршруты для игр
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);
Route::get('/games/{id}/with-genres', [GameController::class, 'showWithGenres']);

// Маршруты для жанров
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);
Route::get('/genres/{id}/with-games', [GenreController::class, 'showWithGames']);

// Маршруты для пользователей
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

// Маршруты для ролей
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/{id}', [RoleController::class, 'show']);
