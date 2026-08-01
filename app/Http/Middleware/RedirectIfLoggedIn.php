<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Kalau pengunjung SUDAH punya sesi aktif (mahasiswa/mentor/admin), langsung
 * arahkan ke home sesuai role-nya — jangan tampilkan landing/undangan atau form
 * login lagi. Ini bikin mahasiswa yang menutup tab lalu membuka ulang situs
 * (selama sesi masih valid) langsung masuk ke /home tanpa login ulang.
 */
class RedirectIfLoggedIn
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('admin_login')) {
            return redirect()->route('admin.home');
        }
        if (session()->has('mentor_login')) {
            return redirect()->route('mentor.home');
        }
        if (session()->has('mahasiswa_login')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
