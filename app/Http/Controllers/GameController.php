<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the games.
     */
    public function index()
    {
        $games = Game::with('developer', 'genre')->get();
        return response()->json($games);
    }

    /**
     * Display the specified game.
     */
    public function show($id)
    {
        $game = Game::with('developer', 'genre')->findOrFail($id);
        return response()->json($game);
    }
}
