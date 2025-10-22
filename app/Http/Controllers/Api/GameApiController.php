<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $games = Game::with(['developer', 'genre', 'genres'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $games,
            'message' => 'Games retrieved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $game = Game::with(['developer', 'genre', 'genres', 'reviews.user'])
            ->find($id);

        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $game,
            'message' => 'Game retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'developer_id' => 'required|exists:developers,id',
            'genre_id' => 'required|exists:genres,id',
            'platform' => 'required|string|max:50',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        $game = Game::create($validated);

        if ($request->has('genres')) {
            $game->genres()->sync($request->genres);
        }

        return response()->json([
            'success' => true,
            'data' => $game->load(['developer', 'genre', 'genres']),
            'message' => 'Game created successfully'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'release_date' => 'sometimes|date',
            'developer_id' => 'sometimes|exists:developers,id',
            'genre_id' => 'sometimes|exists:genres,id',
            'platform' => 'sometimes|string|max:50',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        $game->update($validated);

        if ($request->has('genres')) {
            $game->genres()->sync($request->genres);
        }

        return response()->json([
            'success' => true,
            'data' => $game->load(['developer', 'genre', 'genres']),
            'message' => 'Game updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game not found'
            ], 404);
        }

        $game->delete();

        return response()->json([
            'success' => true,
            'message' => 'Game deleted successfully'
        ]);
    }
}
