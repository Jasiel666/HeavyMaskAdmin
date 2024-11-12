<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ShirtController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Route::get('/', [MainController::class, 'AdminLogin']);

// // Product-related routes
// Route::get('/productsInsert', [MainController::class, 'productsInsert'])->name('productsInsert');
// Route::post('/shirts', [ShirtController::class, 'store'])->name('Shirt.store');
// Route::get('/shirts/list', [ShirtController::class, 'index'])->name('shirts.index');
// Route::get('/shirts/{id}', [ShirtController::class, 'show'])->name('shirts.show');
// Route::get('/shirts/{id}/edit', [ShirtController::class, 'edit'])->name('shirts.edit');
// Route::put('/shirts/{id}', [ShirtController::class, 'update'])->name('shirts.update');
// Route::delete('/shirts/{id}', [ShirtController::class, 'destroy'])->name('shirts.destroy');

// // Admin-related routes

// Route::get('/AdminGrid',[MainController::class, 'AdminGrid'])->name('AdminTable');
// Route::get('/AdminGrid', [AdminController::class, 'index'])->middleware('auth:admin')->name('AdminsTable');


// // Login routes

// Route::get('/login', [MainController::class, 'AdminLogin'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('Login.login');
// Route::get('/logout', [LoginController::class, 'logout'])->name('Login.logout');

// // Registration routes
// Route::get('/register', [MainController::class, 'register']);
// Route::post('/register', [RegisterController::class, 'register'])->name('Register.register');
