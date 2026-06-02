<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'homepage');
Route::view('/filosofi', 'filosofi');
Route::view('/timeline', 'timeline');
Route::view('/group', 'group');
Route::view('/contact', 'contact');