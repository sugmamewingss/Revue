<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister() {
        return view('signup');
    }

public function register(Request $request) {

    $request->validate([
        'username' => 'required|max:50',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed'
    ]);

    User::create([
        'name' => $request->username,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
    ]);

    return redirect()->route('login')->with('success', 'Your account has been created successfully!');
}

    public function showLogin() {
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
        return back()->withErrors([
            'login_error' => 'Email atau password salah'
        ]);
    }

    $request->session()->regenerate();
    return redirect()->route('homepage');
}


    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
