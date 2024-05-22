<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);
Route::middleware(['auth:api'])->group(function () {
Route::post('logout', [AuthController::class, 'Logout']);
});
