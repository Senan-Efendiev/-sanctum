<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use App\Models\Developer;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    public function index(): View
    {
        $perPage = request('per_page', 10);

        $games = Game::with(['developer', 'genre'])
            ->latest()
            ->when(request()->has('search'), function ($query) {
                $query->where('title', 'like', '%'.request('search').'%');
            })
            ->when(request()->has('platform'), function ($query) {
                $query->where('platform', request('platform'));
            })
            ->when(request()->has('genre'), function ($query) {
                $query->whereHas('genres', function ($q) {
                    $q->where('genres.id', request('genre'));
                });
            })
            ->paginate($perPage)
            ->appends(request()->query());

        return view('games.index', compact('games'));
    }

    public function create(): View
    {
        if (Gate::denies('create-games')) {
            abort(403, 'У вас нет прав на создание игр');
        }

        return view('games.create', [
            'developers' => Developer::query()->orderBy('name')->get(),
            'genres' => Genre::query()->orderBy('name')->get()
        ]);
    }

    public function store(StoreGameRequest $request): RedirectResponse
    {
        if (Gate::denies('create-games')) {
            abort(403, 'У вас нет прав на создание игр');
        }

        $game = Game::query()->create($request->validated());

        if ($request->has('genres')) {
            $game->genres()->sync($request->genres);
        }

        return redirect()->route('games.index')
            ->with('success', 'Игра успешно создана!');
    }

    public function show(Game $game)
    {
        return view('games.show', [
            'game' => $game->load(['reviews' => function($query) {
                $query->with('user')->latest();
            }, 'developer', 'genre', 'genres'])
        ]);
    }

    public function edit(Game $game): View
    {
        if (Gate::denies('edit-games')) {
            abort(403, 'У вас нет прав на редактирование игр');
        }

        return view('games.edit', [
            'game' => $game,
            'developers' => Developer::query()->orderBy('name')->get(),
            'genres' => Genre::query()->orderBy('name')->get()
        ]);
    }

    public function update(UpdateGameRequest $request, Game $game): RedirectResponse
    {
        $game->update($request->validated());

        if ($request->has('genres')) {
            $game->genres()->sync($request->genres);
        }

        return redirect()->route('games.index')
            ->with('success', 'Игра успешно обновлена!');
    }

    public function destroy(Game $game): RedirectResponse
    {
        if (Gate::denies('delete-games')) {
            return back()->withErrors(['error' => 'Удаление игр запрещено']);
        }

        $game->delete();

        return redirect()->route('games.index')
            ->with('success', 'Игра отправлена в корзину!');
    }

    public function restore(int $id): RedirectResponse
    {
        Game::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('games.index')
            ->with('success', 'Игра успешно восстановлена!');
    }
}
