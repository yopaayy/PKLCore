<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DudiController;
use App\Http\Controllers\API\PembayaranController;
use App\Http\Controllers\API\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Public Routes (Tidak perlu login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Wajib login dengan token Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // Auth actions
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // CRUD Master Data
    Route::apiResource('dudis', DudiController::class);
    Route::apiResource('siswas', SiswaController::class);

    // --- Rute di bawah ini akan dijaga oleh Middleware Gatekeeper ---
    // User WAJIB melengkapi profile (WA, Alamat, Foto) untuk bisa mengaksesnya
    Route::middleware('App\Http\Middleware\EnsureProfileIsComplete')->group(function () {

        // Contoh endpoint yang butuh data lengkap:
        // Route::post('/pembayaran', [PaymentController::class, 'process']);
        // Route::post('/pengajuan-pkl', [PengajuanController::class, 'store']);

        // Rute Pembayaran / Administrasi
        Route::post('/pembayaran', [PembayaranController::class, 'store']);
        Route::get('/pembayaran', [PembayaranController::class, 'index']);
    });
});
