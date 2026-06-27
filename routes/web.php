<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Auth\LoginController;


// mahasiswa punya
// landing page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Home page
Route::get('/home', function () {
    return view('home');
});
Route::get('homepage', function(){
    return view('homepage');
})->name('homepage');

// Rangkaian
Route::get('rangkaian', function(){
    return view('rangkaian');
})->name('rangkaian');

// Halaman about
Route::get('/about', function () {
    return view('about');
})->name('about');

// Halaman filosofi
Route::get('/filosofi', function () {
    return view('filosofi');
})->name('filosofi');

// Halaman timeline
Route::get('/timeline', function () {
    return view('timeline');
})->name('timeline');

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
})->name('biodata');

Route::get('/poin', function () {
    return view('poin-penilaian-mahasiswa');
})->name('poin');

Route::get('/sertifikat', function () {
    return view('sertifikat-mahasiswa');
})->name('sertifikat');

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


// mentor
Route::prefix('mentor')->group(function () {

    Route::get('/kegiatan', function () {
        return view('mentor.kegiatan');
    })->name('mentor.kegiatan');

    Route::get('/offering/{prodi}', function ($kegiatan) {
        return view('mentor.offering', compact('kegiatan'));
    })->name('mentor.offering');

    Route::get('/mahasiswa', function () {
        return view('mentor.mahasiswa');
    })->name('mentor.mahasiswa');
});