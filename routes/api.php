<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameApiController;
use App\Http\Controllers\Api\DeveloperApiController;
use App\Http\Controllers\Api\GenreApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('games', GameApiController::class);
Route::apiResource('developers', DeveloperApiController::class);
Route::apiResource('genres', GenreApiController::class);

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
