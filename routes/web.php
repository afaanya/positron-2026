<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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

// Home page

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});


Route::get('/home', function () {
    return view('home');
})->name('home');



Route::get('homepage', function(){
    return view('homepage');
})->name('homepage');

//Sambutan
Route::get('sambutan', function(){
    return view('sambutan');
})->name('sambutan');

// Rangkaian
Route::get('rangkaian', function(){
    return view('rangkaian');
})->name('rangkaian');

// Manual Book
Route::get('/manualbook', function () {
    return view('manualbook');
})->name('manualbook');

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

Route::get('/biodata', function () {

    $biodata = DB::table('mahasiswa')
        ->where('id', session('mahasiswa_id'))
        ->first();

     return view('biodata-mahasiswa', compact('biodata'));
})->name('biodata');

Route::get('/poin', function () {
    return view('poin-penilaian-mahasiswa');
})->name('poin');

Route::get('/kartu-kendali', function () {
    return view('kartu-kendali');
})->name('kartu-kendali');

Route::get('/sertifikat', function () {
    return view('sertifikat-mahasiswa');
})->name('sertifikat');


Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ================= HALAMAN SETELAH LOGIN =================

Route::middleware('mahasiswa.auth')->group(function () {

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

    Route::get('/poin', function () {
        return view('poin-penilaian-mahasiswa');
    })->name('poin');

    Route::get('/sertifikat', function () {
        return view('sertifikat-mahasiswa');
    })->name('sertifikat');


    Route::get('/mentor', function () {
        return view('mentor');
    })->name('mentor');

    Route::get('/kegiatan', function () {
        return view('kegiatan');
    })->name('kegiatan');

    Route::middleware('mentor.auth')->prefix('mentor')->group(function () {

        Route::get('/home', function () {
            return view('mentor.home');
        })->name('mentor.home');

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

});