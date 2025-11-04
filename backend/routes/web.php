<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;


// Authentication Routes
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

// Custom Login Routes (jika ingin lebih eksplisit)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('auth')->group(function () {
    Route::resource('users', UserController::class);
});
