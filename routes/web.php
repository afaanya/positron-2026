<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Kreait\Laravel\Firebase\Facades\Firebase;

Route::get('/firebase-test', function () {
    $firestore = Firebase::firestore();
    return "Firebase berhasil terhubung!";
});

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ================= LOGIN =================

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ================= HALAMAN SETELAH LOGIN =================

Route::middleware('mentor.auth')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/homepage', function () {
        return view('homepage');
    })->name('homepage');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/sambutan', function () {
        return view('sambutan');
    })->name('sambutan');

    Route::get('/rangkaian', function () {
        return view('rangkaian');
    })->name('rangkaian');

    Route::get('/manualbook', function () {
        return view('manualbook');
    })->name('manualbook');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/filosofi', function () {
        return view('filosofi');
    })->name('filosofi');

    Route::get('/timeline', function () {
        return view('timeline');
    })->name('timeline');

    Route::get('/profil-mahasiswa', function () {
        return view('profil-mahasiswa');
    })->name('profil');

    Route::get('/biodata', function () {
        return view('biodata-mahasiswa');
    })->name('biodata');

    Route::get('/poin', function () {
        return view('poin-penilaian-mahasiswa');
    })->name('poin');

    Route::get('/sertifikat', function () {
        return view('sertifikat-mahasiswa');
    })->name('sertifikat');

});