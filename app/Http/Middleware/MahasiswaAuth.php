<<<<<<< HEAD
+-
=======
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('mahasiswa_login')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
>>>>>>> 70b3aa30748642085e349296768092501cbead91
