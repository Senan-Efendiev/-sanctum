<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    // Показать форму входа
    public function login()
    {
        return view('auth.login');
    }

    // Аутентификация пользователя
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/games');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные',
        ]);
    }

    // Выход из системы
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Перенаправляем на страницу входа после выхода
        return redirect()->route('login');
    }
}
