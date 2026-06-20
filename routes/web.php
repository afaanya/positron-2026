<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Auth\LoginController;

<<<<<<< HEAD
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return view('filosofi');
});

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

=======
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
>>>>>>> 6c87537de27a312355508fc7fc142aeb6236859e
