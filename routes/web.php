<?php

use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/akreditasi', [AkreditasiController::class, 'index']);

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected admin routes
Route::middleware('auth')->group(function () {
    Route::post('/admin/akreditasi/{subKomponenId}/upload', [AkreditasiController::class, 'upload'])->name('admin.akreditasi.upload');
});
