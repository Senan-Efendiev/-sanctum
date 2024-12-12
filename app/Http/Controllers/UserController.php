<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    /**
     * Display the specified user along with their roles.
     */
    public function show($id) {
        $user = User::findOrFail($id); // Получаем пользователя по ID
        return view('users.show', compact('user'));
    }

}
