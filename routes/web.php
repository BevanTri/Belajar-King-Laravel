<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TentangController;

Route::get('/', [ProfilController::class, 'index']);

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

Route::get('/profil/{id}', [ProfilController::class, 'show'])->name('profil.detail');