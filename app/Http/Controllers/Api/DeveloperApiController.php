<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeveloperApiController extends Controller
{
    public function index(): JsonResponse
    {
        $developers = Developer::with('games')->get();

        return response()->json([
            'success' => true,
            'data' => $developers,
            'message' => 'Developers retrieved successfully'
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $developer = Developer::with('games')->find($id);

        if (!$developer) {
            return response()->json([
                'success' => false,
                'message' => 'Developer not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $developer,
            'message' => 'Developer retrieved successfully'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'founded' => 'required|date',
        ]);

        $developer = Developer::create($validated);

        return response()->json([
            'success' => true,
            'data' => $developer,
            'message' => 'Developer created successfully'
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $developer = Developer::find($id);

        if (!$developer) {
            return response()->json([
                'success' => false,
                'message' => 'Developer not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'founded' => 'sometimes|date',
        ]);

        $developer->update($validated);

        return response()->json([
            'success' => true,
            'data' => $developer,
            'message' => 'Developer updated successfully'
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $developer = Developer::find($id);

        if (!$developer) {
            return response()->json([
                'success' => false,
                'message' => 'Developer not found'
            ], 404);
        }

        $developer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Developer deleted successfully'
        ]);
    }
}
