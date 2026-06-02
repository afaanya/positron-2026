<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilosofiController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/filosofi', [FilosofiController::class, 'index']);
Route::get('/timeline', [TimelineController::class, 'index']);
Route::get('/group', [GroupController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);