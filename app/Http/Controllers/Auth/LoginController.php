<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'identifier' => 'required',
        'password' => 'required',
    ]);

    // Cek mentor
    $mentor = DB::table('mentor')
        ->where('user', $request->identifier)
        ->first();

    if ($mentor && $mentor->password == $request->password) {

        $request->session()->put('mentor_login', true);
        $request->session()->put('mentor_user', $mentor->user);
        $request->session()->regenerate();

        return redirect()->route('mentor.home');
    }

    // Cek mahasiswa
    $mahasiswa = DB::table('mahasiswa')
        ->where('id', $request->identifier)
        ->first();

    if ($mahasiswa && $mahasiswa->password == $request->password) {

        $request->session()->regenerate();

        $request->session()->put('mahasiswa_login', true);
        $request->session()->put('mahasiswa_id', $mahasiswa->id);

        return redirect()->route('home');
    }

    return back()->withErrors([
        'identifier' => 'Username atau password salah.',
    ]);
}

    public function logout(Request $request)
    {
        $request->session()->forget([
            'mentor_login',
            'mentor_user',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}