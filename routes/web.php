<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Auth\LoginController;

// Redirect jika sudah login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('landing');
})->name('home');

// Halaman filosofi
Route::get('/filosofi', function () {
    return view('filosoficoba');
})->name('filosofi');

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
