<?php

use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\AuthController;

// Public routes (Only accessible to guests)
Route::middleware('guest')->group(function () {
    // Auth routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Public routes accessible by everyone (guest or auth)
Route::get('/', [AkreditasiController::class, 'index']);
// Keep /akreditasi as an alias just in case some hardcoded links exist
Route::get('/akreditasi', [AkreditasiController::class, 'index']);
Route::get('/dokumen/{id}/view', [AkreditasiController::class, 'viewDocument'])->name('dokumen.view');

// Language switcher route
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Protected admin routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/dashboard', [AkreditasiController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/report', [AkreditasiController::class, 'exportReport'])->name('admin.report');
    Route::post('/admin/akreditasi/{subKomponenId}/upload', [AkreditasiController::class, 'upload'])->name('admin.akreditasi.upload');
    Route::post('/admin/akreditasi/upload/{type}/{id}', [AkreditasiController::class, 'upload'])->name('admin.akreditasi.upload.spesifik');
    Route::delete('/admin/akreditasi/dokumen/{id}', [AkreditasiController::class, 'deleteDokumen'])->name('admin.dokumen.delete');
});


