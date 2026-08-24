<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\PasswordHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        if ($admin && PasswordHelper::matches($request->password, $admin->password)) {
            if (PasswordHelper::needsRehash($admin->password)) {
                DB::table('admin')->where('username', $admin->username)
                    ->update(['password' => Hash::make($request->password)]);
            }

            $request->session()->put('admin_login', true);
            $request->session()->put('admin_user', $admin->username);
            $request->session()->regenerate();

            return redirect()->route('admin.home');
        }

        // Cek mentor
        // PENTING: kolom 'user' di tabel mentor menyimpan kode offering
        // (mis. "TI-A"), dan BISA dipakai oleh lebih dari satu mentor
        // sekaligus (beberapa mentor per offering). Kalau cuma ambil
        // ->first(), password dicek ke baris yang salah untuk mentor
        // selain yang pertama tersimpan. Jadi di sini kita cek password
        // ke SEMUA baris yang identifier-nya cocok, cari yang match.
        $mentorCandidates = DB::table('mentor')
            ->where('user', $request->identifier)
            ->get();

        $mentor = $mentorCandidates->first(
            fn ($m) => PasswordHelper::matches($request->password, $m->password)
        );

        if ($mentor) {
            if (PasswordHelper::needsRehash($mentor->password)) {
                // Update SPESIFIK baris ini (pakai id), bukan where('user', ...)
                // — soalnya 'user' bisa dipakai banyak mentor sekaligus, kalau
                // pakai where('user', ...) password mentor lain di offering
                // yang sama ikut ketiban ke-overwrite.
                DB::table('mentor')->where('id', $mentor->id)
                    ->update(['password' => Hash::make($request->password)]);
            }

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

        if ($mahasiswa && PasswordHelper::matches($request->password, $mahasiswa->password)) {
            if (PasswordHelper::needsRehash($mahasiswa->password)) {
                DB::table('mahasiswa')->where('id', $mahasiswa->id)
                    ->update(['password' => Hash::make($request->password)]);
            }

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