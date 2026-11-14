<?php

use Illuminate\Support\Facades\Route;
use Modules\Buku\Http\Controllers\BukuController;

Route::middleware('auth')->group(function () {
    // Admin dan user boleh melihat daftar buku
    Route::get('buku', [BukuController::class, 'index'])
        ->middleware('role:admin,user')
        ->name('buku.index');

    // Hanya admin yang boleh mengelola data buku
    Route::middleware('role:admin')->group(function () {
        Route::get('buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('buku/{buku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('buku/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');
    });
});