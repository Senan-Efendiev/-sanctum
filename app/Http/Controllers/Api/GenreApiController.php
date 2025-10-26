<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(): JsonResponse
    {
        $genres = Genre::with('games')->get();

        return response()->json([
            'success' => true,
            'data' => $genres,
            'message' => 'Genres retrieved successfully'
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $genre = Genre::with('games')->find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $genre,
            'message' => 'Genre retrieved successfully'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres',
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'data' => $genre,
            'message' => 'Genre created successfully'
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:genres,name,' . $id,
        ]);

        $genre->update($validated);

        return response()->json([
            'success' => true,
            'data' => $genre,
            'message' => 'Genre updated successfully'
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre deleted successfully'
        ]);
    }
}
