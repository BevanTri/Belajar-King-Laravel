<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TentangController;

Route::get('/', [ProfilController::class, 'index']);

Route::resource('mahasiswa', ProfilController::class);

Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
