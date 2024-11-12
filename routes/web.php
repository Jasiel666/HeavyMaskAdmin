<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ShirtController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;


Route::get('/', [MainController::class, 'AdminLogin']);

// Product-related routes
Route::get('/productsInsert', [MainController::class, 'productsInsert'])->name('productsInsert');
Route::post('/shirts', [ShirtController::class, 'store'])->name('Shirt.store');
Route::get('/shirts/list', [ShirtController::class, 'index'])->name('shirts.index');
Route::get('/shirts/{id}', [ShirtController::class, 'show'])->name('shirts.show');
Route::get('/shirts/{id}/edit', [ShirtController::class, 'edit'])->name('shirts.edit');
Route::put('/shirts/{id}', [ShirtController::class, 'update'])->name('shirts.update');
Route::delete('/shirts/{id}', [ShirtController::class, 'destroy'])->name('shirts.destroy');

// Admin-related routes

// Display the grid of admins (GET request, calls 'index' in AdminController)
Route::get('/AdminGrid', [AdminController::class, 'index'])->name('AdminsTable');
Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');

// Show the form for creating a new admin (GET request, calls 'create' in AdminController)
Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');

// Store a new admin in the database (POST request, calls 'store' in AdminController)
Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');

// Show the form for editing an admin (GET request, calls 'edit' in AdminController)
Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');

// Update the specified admin (PUT request, calls 'update' in AdminController)
Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');

// Delete the specified admin (DELETE request, calls 'destroy' in AdminController)
Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');


// Login routes

Route::get('/login', [MainController::class, 'AdminLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('Login.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('Login.logout');

// Registration routes
Route::get('/register', [MainController::class, 'register']);
Route::post('/register', [RegisterController::class, 'register'])->name('Register.register');

//User Routes
Route::get('/UserTable', [MainController::class, 'UserGrid'])->name('UserTable');
Route::get('/UsersTable', [UserController::class, 'index'])->name('UsersTable');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//Order Routes

Route::get('/Order', [OrderController::class, 'index'])->name('OrderTable');