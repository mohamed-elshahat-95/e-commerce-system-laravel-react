<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Get All Products
    Route::get('/products', [ProductController::class, 'index']);

    // Create Product
    Route::post('/products/create', [ProductController::class, 'store']);
    
    // Get All Orders
    Route::get('/orders', [OrderController::class, 'index']);

    // Create Order
    Route::post('/orders', [OrderController::class, 'store']);

    // Get Order Details
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});