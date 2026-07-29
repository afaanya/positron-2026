<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

        $request->session()->forget([
            'admin_login',
            'admin_user',
            'mentor_login',
            'mentor_user',
            'mahasiswa_login',
            'mahasiswa_id',
        ]);

        // Cek Admin
        $admin = DB::table('admin')
            ->where('username', $request->identifier)
            ->first();

        if ($admin && $admin->password == $request->password) {

            $request->session()->put('admin_login', true);
            $request->session()->put('admin_user', $admin->username);
            $request->session()->regenerate();

            return redirect()->route('admin.home');
        }

        // Cek mentor
        $mentor = DB::table('mentor')
            ->where('user', $request->identifier)
            ->where('password', $request->password)
            ->first();

        if ($mentor) {

            $request->session()->put('mentor_login', true);
            $request->session()->put('mentor_user', $mentor->user);
            $request->session()->put('mentor_nama', $mentor->nama_panggilan);
            $request->session()->regenerate();

            return redirect()->route('mentor.home');
        }

        // Cek mahasiswa (kolom id-nya bigint, jadi cuma query kalau identifier-nya angka)
        $mahasiswa = null;
        if (ctype_digit((string) $request->identifier)) {
            $mahasiswa = DB::table('mahasiswa')
                ->where('id', $request->identifier)
                ->first();
        }

        if ($mahasiswa && $mahasiswa->password == $request->password) {

            $request->session()->put('mahasiswa_login', true);
            $request->session()->put('mahasiswa_id', $mahasiswa->id);
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'identifier' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        $logId = $request->session()->get('mentor_login_log_id');
        if ($logId && Schema::hasTable('mentor_login_log')) {
            DB::table('mentor_login_log')
                ->where('id', $logId)
                ->update([
                    'logout_at'  => now(),
                    'updated_at' => now(),
                ]);
        }

        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}