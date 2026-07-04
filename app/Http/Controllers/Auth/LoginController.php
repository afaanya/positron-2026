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
    $mentor = DB::table('mentor')
        ->where('user', $request->identifier)
        ->first();

        $request->session()->put('mentor_login', true);
        $request->session()->put('mentor_user', $mentor->user);
        $request->session()->regenerate();

        return redirect()->route('home');

    dd([
        'mentor' => $mentor,
        'input_password' => $request->password,
        'db_password' => $mentor?->password,
        'password_sama' => $mentor?->password == $request->password,
        'password_identik' => $mentor?->password === $request->password,
        'tipe_db' => gettype($mentor?->password),
        'tipe_input' => gettype($request->password),
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