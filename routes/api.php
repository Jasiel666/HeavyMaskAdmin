<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ShirtController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/shirts', [ShirtController::class, 'index']);
Route::get('/shirts/{id}', [ShirtController::class, 'show']);
Route::get('/shirts/{id}/info', [ShirtController::class, 'showShirtInfo']);

// All authenticated routes with rate limiting
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Protected shirt routes
    Route::prefix('shirts')->group(function () {
        Route::post('/', [ShirtController::class, 'store']);
        Route::put('/{id}', [ShirtController::class, 'update']);
        Route::delete('/{id}', [ShirtController::class, 'destroy']);
    });
    
    // Admin routes
    Route::prefix('admins')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::post('/', [AdminController::class, 'store']);
        Route::get('/{id}', [AdminController::class, 'show']);
        Route::put('/{id}', [AdminController::class, 'update']);
        Route::delete('/{id}', [AdminController::class, 'destroy']);
    });
    
    // User routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
});