<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    /**
     * Display the specified user along with their roles.
     */
    public function show($id) {
        $user = User::findOrFail($id); // Получаем пользователя по ID
        return view('user.show', compact('user'));
    }

}
