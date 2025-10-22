<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $genres = Genre::with('games')->get();

        return response()->json([
            'success' => true,
            'data' => $genres,
            'message' => 'Genres retrieved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
