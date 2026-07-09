<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MentorController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// ================= LANDING =================

Route::get('/', function () {
    return view('landing');
})->name('landing');

// ================= AUTH =================

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================= HALAMAN BERSAMA (semua role yang sudah login) =================

Route::middleware('auth.any')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/homepage', function () {
        return view('page', ['inner' => 'homepage', 'title' => 'POSITRON 2026']);
    })->name('homepage');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/sambutan', function () {
        return view('page', ['inner' => 'sambutan', 'title' => 'Sambutan - POSITRON 2026']);
    })->name('sambutan');

    Route::get('/rangkaian', function () {
        return view('page', ['inner' => 'rangkaian', 'title' => 'Rangkaian - POSITRON 2026']);
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
});

// ================= HALAMAN MAHASISWA =================

Route::middleware('mahasiswa.auth')->group(function () {

    Route::get('/biodata', function () {
        $biodata = DB::table('mahasiswa')
            ->where('id', session('mahasiswa_id'))
            ->first();

        return view('biodata-mahasiswa', compact('biodata'));
    })->name('biodata');

    Route::get('/profil-mahasiswa', function () {
        return view('profil-mahasiswa');
    })->name('profil');

    Route::get('/poin', function () {
        return view('poin-penilaian-mahasiswa');
    })->name('poin');

    Route::get('/kartu-kendali', function () {
        return view('kartu-kendali');
    })->name('kartu-kendali');

    Route::get('/sertifikat', function () {
        return view('sertifikat-mahasiswa');
    })->name('sertifikat');
});

// ================= HALAMAN MENTOR =================

Route::middleware('mentor.auth')->prefix('mentor')->group(function () {

    Route::get('/home', [MentorController::class, 'home'])->name('mentor.home');

    Route::post('/penilaian', [MentorController::class, 'savePenilaian'])
        ->name('mentor.penilaian.save');

    Route::get('/kegiatan', function () {
        return view('mentor.kegiatan');
    })->name('mentor.kegiatan');

    Route::get('/mahasiswa', function () {
        return view('mentor.mahasiswa');
    })->name('mentor.mahasiswa');

    Route::get('/offering', function () {
        return view('mentor.offering');
    })->name('mentor.offering');
});

// ================= HALAMAN ADMIN =================

Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    Route::get('/mahasiswa', function () {
        return view('admin.mahasiswa');
    })->name('mahasiswa');

    Route::get('/mentor', function () {
        return view('admin.mentor');
    })->name('mentor');

    Route::get('/offering', function () {
        return view('admin.offering');
    })->name('offering');
});
