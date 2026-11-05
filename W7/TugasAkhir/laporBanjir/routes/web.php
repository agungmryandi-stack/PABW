<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman awal langsung ke form lapor warga
Route::get('/', function () {
    return redirect()->route('laporan.create');
});

// ===== PUBLIK: warga tanpa login, cuma boleh form + kirim =====
Route::resource('laporan', LaporanController::class)->only(['create', 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===== PETUGAS: wajib login =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // index, show, edit, update, destroy (create & store sudah di atas)
    Route::resource('laporan', LaporanController::class)->except(['create', 'store']);
});

require __DIR__.'/auth.php';