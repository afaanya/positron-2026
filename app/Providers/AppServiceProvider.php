<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Rate limit login: dikunci PER-AKUN (bukan cuma per-IP) supaya banyak
        // mahasiswa yang login dari WiFi/NAT yang sama (mis. kampus) tidak saling
        // memblokir. Batas per-IP dibuat longgar hanya sebagai rem anti-abuse.
        RateLimiter::for('login', function (Request $request) {
            $id = strtolower(trim((string) $request->input('identifier')));

            return [
                Limit::perMinute(10)->by('login-acct:' . $id),
                Limit::perMinute(120)->by('login-ip:' . $request->ip()),
            ];
        });
    }
}
