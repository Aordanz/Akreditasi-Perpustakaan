<?php

use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\AuthController;

// Public routes (Only accessible to guests)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/profil', function () {
        return view('profil');
    });

    // Auth routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Public routes accessible by everyone (guest or auth)
Route::get('/akreditasi', [AkreditasiController::class, 'index']);
Route::get('/dokumen/{id}/view', [AkreditasiController::class, 'viewDocument'])->name('dokumen.view');

// Protected admin routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/dashboard', [AkreditasiController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/report', [AkreditasiController::class, 'exportReport'])->name('admin.report');
    Route::post('/admin/akreditasi/{subKomponenId}/upload', [AkreditasiController::class, 'upload'])->name('admin.akreditasi.upload');
    Route::delete('/admin/akreditasi/dokumen/{id}', [AkreditasiController::class, 'deleteDokumen'])->name('admin.dokumen.delete');
});
