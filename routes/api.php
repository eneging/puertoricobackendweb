<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataGlobalController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservableItemController;
use App\Http\Controllers\ServiceTypeController;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// User routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index']); // Get all users
    Route::get('/users/{id}', [UserController::class, 'show']); // Get specific user
    Route::put('/users/{id}', [UserController::class, 'update']); // Update user
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete user
});

// ServiceType routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/service-types', [ServiceTypeController::class, 'index']); // Get all service types
    Route::get('/service-types/{id}', [ServiceTypeController::class, 'show']); // Get specific service type
    Route::post('/service-types', [ServiceTypeController::class, 'store']); // Create service type
    Route::put('/service-types/{id}', [ServiceTypeController::class, 'update']); // Update service type
    Route::delete('/service-types/{id}', [ServiceTypeController::class, 'destroy']); // Delete service type
});

// ReservableItem routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/reservable-items', [ReservableItemController::class, 'index']); // Get all reservable items
    Route::get('/reservable-items/{id}', [ReservableItemController::class, 'show']); // Get specific reservable item
    Route::post('/reservable-items', [ReservableItemController::class, 'store']); // Create reservable item
    Route::put('/reservable-items/{id}', [ReservableItemController::class, 'update']); // Update reservable item
    Route::delete('/reservable-items/{id}', [ReservableItemController::class, 'destroy']); // Delete reservable item
});

// Reservation routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index']); // Get all reservations
    Route::get('/reservations/{id}', [ReservationController::class, 'show']); // Get specific reservation
    Route::post('/reservations', [ReservationController::class, 'store']); // Create reservation
    Route::put('/reservations/{id}', [ReservationController::class, 'update']); // Update reservation
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']); // Delete reservation
});


Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Rutas protegidas para administrador
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});

Route::get('/product-categories', [ProductCategoryController::class, 'index']);
Route::get('/product-categories/{productCategory}', [ProductCategoryController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/product-categories', [ProductCategoryController::class, 'store']);
    Route::put('/product-categories/{productCategory}', [ProductCategoryController::class, 'update']);
    Route::delete('/product-categories/{productCategory}', [ProductCategoryController::class, 'destroy']);
});

   // Offers

   Route::get('/offers', [OfferController::class, 'index']);
Route::get('/offers/{id}', [OfferController::class, 'show']);

   Route::middleware(['auth-sanctum'])->group(function(){
    Route::post('/offers', [OfferController::class, 'store']);
    Route::put('/offers/{id}', [OfferController::class, 'update']);
    Route::delete('/offers/{id}', [OfferController::class, 'destroy']);
   });
    
   Route::post('/orders', [OrderController::class, 'store']);

   Route::middleware('auth:sanctum')->group(function () {
    Route::post('/data-global', [DataGlobalController::class, 'store']);
    Route::put('/data-global/{id}', [DataGlobalController::class, 'update']);
    Route::delete('/data-global/{id}', [DataGlobalController::class, 'destroy']);
});


Route::get('/data-global', [DataGlobalController::class, 'index']);
Route::get('/data-global/{name}', [DataGlobalController::class, 'show']);