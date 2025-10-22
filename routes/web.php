<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;

// Основные ресурсы
Route::resource('developers', DeveloperController::class);
Route::resource('games', GameController::class);
Route::resource('genres', GenreController::class);
Route::resource('users', UserController::class);
Route::resource('reviews', ReviewController::class);

// Восстановление удаленных игр
Route::post('games/{id}/restore', [GameController::class, 'restore'])
    ->name('games.restore');

// Домашняя страница
Route::get('/', function () {
    return view('welcome');
});

// Корзина с удаленными играми
Route::get('games/trashed', [GameController::class, 'trashed'])
    ->name('games.trashed');

// Полное удаление
Route::delete('games/{id}/force-delete', [GameController::class, 'forceDelete'])
    ->name('games.force-delete');

// Аутентификация
Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('login.authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

// Защищенные маршруты
Route::middleware(['auth'])->group(function() {
    Route::resource('developers', DeveloperController::class)->except(['index', 'show']);
    Route::resource('genres', GenreController::class)->except(['index', 'show']);
    Route::resource('games', GameController::class)->except(['index', 'show']);

    // Убедитесь, что эти маршруты используют стандартные имена ресурсных маршрутов
    Route::get('/games/create', [GameController::class, 'create'])
        ->name('games.create')
        ->middleware('can:create-games');
    Route::post('/games', [GameController::class, 'store'])
        ->name('games.store')
        ->middleware('can:create-games');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])
        ->name('games.destroy')
        ->middleware('can:delete-games');
});

// Маршруты пользователей
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::resource('users', UserController::class)->only(['index', 'create', 'store']);

// Маршрут для проверки всех игр
Route::get('/debug/games', function () {
    $games = \App\Models\Game::with(['developer', 'genre'])->get();

    echo "<h1>Все игры в базе:</h1>";
    foreach ($games as $game) {
        echo "ID: {$game->id} - {$game->title} (Разработчик: {$game->developer->name})<br>";
    }

    echo "<h2>Количество игр: " . $games->count() . "</h2>";

    // Также покажем в JSON формате
    return response()->json($games);
});
