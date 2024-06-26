<?php

use App\Http\Controllers\Absen\AbsenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DaftarWajah\DaftarWajahController;
use App\Http\Controllers\Hari\HariController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Kelas\KelasController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Waktu\WaktuController;
use App\Models\daftarWajah;

// Route to get the authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Authentication routes
Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);
Route::apiResource('dosen', DosenController::class);
Route::apiResource('kelas', KelasController::class);
Route::apiResource('hari', HariController::class);
Route::apiResource('waktu', WaktuController::class);
Route::apiResource('siswa', SiswaController::class);
Route::apiResource('daftarwajah', DaftarWajahController ::class);
Route::apiResource('absen', AbsenController ::class);

// Group routes that require authentication
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'Logout']);
});
