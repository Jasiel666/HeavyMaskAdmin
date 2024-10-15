<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ShirtController;

Route::get('/', [MainController::class, 'AdminLogin']);

// Product-related routes
Route::get('/productsInsert', [MainController::class, 'productsInsert']);
Route::post('/shirts', [ShirtController::class, 'store'])->name('Shirt.store');
Route::get('/shirts/list', [ShirtController::class, 'index'])->name('shirts.index');
Route::get('/shirts/{id}', [ShirtController::class, 'show'])->name('shirts.show');
Route::get('/shirts/{id}/edit', [ShirtController::class, 'edit'])->name('shirts.edit');
Route::put('/shirts/{id}', [ShirtController::class, 'update'])->name('shirts.update');
Route::delete('/shirts/{id}', [ShirtController::class, 'destroy'])->name('shirts.destroy');

// Admin-related routes

Route::get('/AdminGrid',[MainController::class, 'AdminGrid']);