<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Allows access to shared pages (home, about, filosofi, timeline, ...)
 * for ANY logged-in role: mahasiswa, mentor, or admin.
 */
class AnyAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! session()->has('mahasiswa_login') &&
            ! session()->has('mentor_login') &&
            ! session()->has('admin_login')
        ) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
