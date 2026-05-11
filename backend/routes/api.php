<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;




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

    // --- Rute di bawah ini akan dijaga oleh Middleware Gatekeeper ---
    // User WAJIB melengkapi profile (WA, Alamat, Foto) untuk bisa mengaksesnya
    Route::middleware('App\Http\Middleware\EnsureProfileIsComplete')->group(function () {

        // Contoh endpoint yang butuh data lengkap:
        // Route::post('/pembayaran', [PaymentController::class, 'process']);
        // Route::post('/pengajuan-pkl', [PengajuanController::class, 'store']);

    });
});
