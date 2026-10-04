<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// ================= LANDING =================

// Landing: kalau sudah login, langsung ke home (skip undangan). Kalau belum, tampilkan landing.
Route::get('/', function () {
    return view('landing');
})->middleware('guest.any')->name('landing');

// ================= AUTH =================

Route::middleware('guest.any')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // throttle 'login' (lihat AppServiceProvider): per-akun 10/mnt + per-IP 120/mnt,
    // supaya banyak mahasiswa dari WiFi yang sama tidak saling memblokir.
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login');
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

    Route::get('/sambutan', function () {
        return view('page', ['inner' => 'sambutan', 'title' => 'Sambutan - POSITRON 2026']);
    })->name('sambutan');

    Route::get('/rangkaian', function () {
        return view('page', ['inner' => 'rangkaian', 'title' => 'Rangkaian - POSITRON 2026']);
    })->name('rangkaian');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/filosofi', function () {
        return view('filosofi');
    })->name('filosofi');

    Route::get('/timeline', function () {
        return view('timeline');
    })->name('timeline');

    Route::get('/penugasan', function () {
        return view('penugasan');
    })->name('penugasan');
});

// ================= HALAMAN MAHASISWA =================

Route::middleware('mahasiswa.auth')->group(function () {

    Route::get('/biodata', function () {
        $biodata = DB::table('mahasiswa')
            ->leftJoin('kelompok', 'kelompok.id', '=', 'mahasiswa.kelompok_id')
            ->where('mahasiswa.id', session('mahasiswa_id'))
            ->select('mahasiswa.*', 'kelompok.nama as kelompok_nama', 'kelompok.mentor as kelompok_mentor')
            ->first();

        // Admin juga lolos mahasiswa.auth tapi tidak punya mahasiswa_id.
        if (! $biodata) {
            return redirect()->route('home');
        }

        $mentors = DB::table('mentor')
            ->where('user', $biodata->offering)
            ->whereNotNull('no_wa')
            ->get();

        return view('biodata-mahasiswa', compact('biodata', 'mentors'));
    })->name('biodata');
    
    Route::get('/biodata/edit', [MahasiswaController::class, 'edit'])
        ->name('biodata.edit');

    Route::post('/biodata/update', [MahasiswaController::class, 'update'])
        ->name('biodata.update');

    Route::get('/poin', [MahasiswaController::class, 'poin'])
        ->name('poin');

    Route::get('/kartu-kendali', [MahasiswaController::class, 'kartuKendali'])
        ->name('kartu-kendali');

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

    Route::get('/riwayat-login', [MentorController::class, 'riwayatLogin'])->name('riwayat-login');
});
