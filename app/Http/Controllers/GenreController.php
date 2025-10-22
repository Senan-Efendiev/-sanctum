<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(StoreGenreRequest $request)
    {
        Genre::create($request->validated());
        return redirect()->route('genres.index')
            ->with('success', 'Жанр успешно создан!');
    }

    public function show($id)
    {
        $genre = Genre::with('games')->findOrFail($id);
        return view('genres.show', compact('genre'));
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }

    public function update(UpdateGenreRequest $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($request->validated());
        return redirect()->route('genres.index')
            ->with('success', 'Жанр успешно обновлен!');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return redirect()->route('genres.index')
            ->with('success', 'Жанр успешно удален!');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}
