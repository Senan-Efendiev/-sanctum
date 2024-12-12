<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the genres.
     */
    public function index()
    {
        $genres = Genre::with('games')->get();
        return view('genres.index', compact('genres'));
    }

    /**
     * Display the specified genre along with its games.
     */
    public function show($id)
    {
        $genre = Genre::with('games')->findOrFail($id);
        return view('genres.show', compact('genre'));
    }
}
