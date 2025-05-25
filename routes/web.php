<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Landing page route
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication routes
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
