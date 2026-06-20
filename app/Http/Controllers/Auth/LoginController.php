<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password'   => 'required|string',
        ], [
            'identifier.required' => 'Email atau NIM wajib diisi.',
            'password.required'   => 'Kata sandi wajib diisi.',
        ]);

        $identifier = $request->identifier;

        // Tentukan apakah input adalah email atau NIM
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'nim';

        $credentials = [
            $field     => $identifier,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')
                ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('identifier', 'remember'))
            ->withErrors([
                'identifier' => 'Email/NIM atau kata sandi salah.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}