<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('reviews')->paginate(10); // Добавляем пагинацию
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8|max:255',
                'isadmin' => 'required|boolean',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'isadmin' => (bool)$validated['isadmin'],
            ]);

            return redirect('/users')->with('success', 'Пользователь успешно создан');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Ошибка при создании пользователя: ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        // Загружаем отзывы пользователя с пагинацией
        $reviews = $user->reviews()->with('game')->latest()->paginate(5);

        return view('users.show', [
            'user' => $user,
            'reviews' => $reviews
        ]);
    }
}
