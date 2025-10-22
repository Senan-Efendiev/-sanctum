<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;
use Illuminate\Routing\Controller as BaseController;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        return view('developers.index', compact('developers'));
    }

    public function create()
    {
        return view('developers.create');
    }

    public function store(StoreDeveloperRequest $request)
    {
        Developer::create($request->validated());
        return redirect()->route('developers.index')
            ->with('success', 'Разработчик успешно создан!');
    }

    public function show($id)
    {
        $developer = Developer::with('games')->findOrFail($id);
        return view('developers.show', compact('developer'));
    }

    public function edit($id)
    {
        $developer = Developer::findOrFail($id);
        return view('developers.edit', compact('developer'));
    }

    public function update(UpdateDeveloperRequest $request, $id)
    {
        $developer = Developer::findOrFail($id);
        $developer->update($request->validated());
        return redirect()->route('developers.index')
            ->with('success', 'Разработчик успешно обновлен!');
    }

    public function destroy($id)
    {
        $developer = Developer::findOrFail($id);
        $developer->delete();
        return redirect()->route('developers.index')
            ->with('success', 'Разработчик успешно удален!');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}
