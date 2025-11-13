<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MaterialInController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\Warehouse\CategoryController;


// Authentication Routes
Auth::routes();

// Custom Login Routes (jika ingin lebih eksplisit)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth:employee');

Route::middleware(['auth:employee'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::resource('employees', EmployeeController::class);
    });

    Route::prefix('inventory')->group(function () {
        Route::resource('categories', CategoryController::class);
        // Route::resource('products', ProductController::class);
    });
    
    Route::prefix('distribution')->group(function () {
        Route::resource('suppliers', SupplierController::class);
        Route::resource('material_ins', MaterialInController::class);
        Route::resource('material_outs', MaterialOutController::class);
    });
});
