<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me()
    {
        return response(['user' => auth()->user()]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();
            return response(['user' => auth()->user()]);
        }

        return response(['message' => 'Invalid Credentials'], 401);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return response(['message' => 'Logged out']);
    }
}
