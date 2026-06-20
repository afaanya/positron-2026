<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Auth\LoginController;

// Halaman landing (root)
Route::get('/', function () {
    return view('landing');
})->name('home');

// Redirect jika sudah login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('landing');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');