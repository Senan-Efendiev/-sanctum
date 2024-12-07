<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the developers.
     */
    public function index()
    {
        $developers = Developer::all();
        return response()->json($developers);
    }

    /**
     * Display the specified developer along with their games.
     */
    public function show($id)
    {
        $developer = Developer::with('games')->findOrFail($id);
        return response()->json($developer);
    }
}
