<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameApiController;
use App\Http\Controllers\Api\DeveloperApiController;
use App\Http\Controllers\Api\GenreApiController;
use App\Http\Controllers\Api\AuthController;

// Public routes - без аутентификации
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Public API routes (только чтение)
Route::apiResource('games', GameApiController::class)->only(['index', 'show']);
Route::apiResource('developers', DeveloperApiController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreApiController::class)->only(['index', 'show']);

Route::get('/games/{id}/reviews', function ($id) {
    $game = \App\Models\Game::with('reviews.user')->find($id);

    if (!$game) {
        return response()->json([
            'success' => false,
            'message' => 'Игра не найдена'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $game->reviews,
        'message' => 'Обзоры игр успешно получены'
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Protected API routes
    Route::apiResource('games', GameApiController::class)->except(['index', 'show']);
    Route::apiResource('developers', DeveloperApiController::class)->except(['index', 'show']);
    Route::apiResource('genres', GenreApiController::class)->except(['index', 'show']);

    // Дополнительные защищенные маршруты
    Route::post('/games/{id}/rate', function ($id) {
        $game = \App\Models\Game::find($id);

        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully',
            'game_id' => $id,
            'user_id' => auth()->id()
        ]);
    });

    // Защищенный маршрут для массового создания игр
    Route::post('/games/bulk-create', [GameApiController::class, 'bulkCreate']);
});

