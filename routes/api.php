<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dosen\DosenController;

// Route to get the authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Authentication routes
Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);
Route::apiResource('dosen', DosenController::class);

// Group routes that require authentication
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'Logout']);
});
