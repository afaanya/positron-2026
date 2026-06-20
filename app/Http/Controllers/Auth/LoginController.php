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
        'identifier' => ['required', 'regex:/^[0-9]+$/'],
        'password'   => 'required|string',
    ], [
        'identifier.required' => 'ID wajib diisi.',
        'identifier.regex'    => 'ID hanya boleh angka.',
        'password.required'   => 'Kata sandi wajib diisi.',
    ]);

    $credentials = [
        'id_user'  => $request->identifier,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/home');
    }

    return back()
        ->withInput($request->only('identifier', 'remember'))
        ->withErrors([
            'identifier' => 'ID atau kata sandi salah.',
        ]);
}}