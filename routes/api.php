<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\MahasiswaApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/mahasiswas', [MahasiswaApiController::class, 'index']);
    Route::get('/mahasiswas/{id}', [MahasiswaApiController::class, 'show']);
    Route::post('/mahasiswas', [MahasiswaApiController::class, 'store']);
    Route::put('/mahasiswas/{id}', [MahasiswaApiController::class, 'update']);
    Route::delete('/mahasiswas/{id}', [MahasiswaApiController::class, 'destroy']);
});
