<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Auth\LoginController;


// mahasiswa punya
// Redirect jika sudah login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('landing');
})->name('home');

// Home page
Route::get('homepage', function(){
    return view('mahasiswa.homepage');
})->name('home');

// Halaman about
Route::get('/about', function () {
    return view('about');
});


// Halaman profil mahasiswa
Route::get('/profil-mahasiswa', function () {
    return view('profil-mahasiswa');
})->name('profil');

Route::get('/biodata', function () {
    $contact = '081234567890';
    $biodata = (object) [
        'nama' => 'abcdef',
        'nim' => '123456789',
        'program_studi' => 'Teknik Informatika',
        'offering' => 'TI A',
        'kakak_mentor' => 'klmnop',
        'contact' => 'https://wa.me/62' .ltrim($contact, '0'),
        'kelompok' => 'Kelompok 1',
        'mentor_kelompok' => 'uvwxyz'
    ];
    return view('biodata-mahasiswa', compact('biodata'));
});

Route::get('/poin', function () {
    return view('poin-penilaian-mahasiswa');
});

Route::get('/sertifikat', function () {
    return view('sertifikat-mahasiswa');
});

// Halaman filosofi
Route::get('/filosofi', function () {
    return view('filosofi');
})->name('filosofi');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Halaman Timeline
Route::get('/timeline', function () {
    return view('timeline');
});


// mentor punya
Route::prefix('mentor')->group(function () {

    Route::get('/kegiatan', function () {
        return view('mentor.kegiatan');
    })->name('mentor.prodi');

    Route::get('/offering/{prodi}', function ($kegiatan) {
        return view('mentor.offering', compact('kegiatan'));
    })->name('mentor.offering');

    Route::get('/mahasiswa', function () {
        return view('mentor.mahasiswa');
    })->name('mentor.mahasiswa');

});