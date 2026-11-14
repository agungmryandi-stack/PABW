<?php

use Illuminate\Support\Facades\Route;
use Modules\Pendaftaran\Http\Controllers\PendaftaranController;

Route::middleware(['auth', 'role:admin,user'])
    ->prefix('pendaftaran')
    ->name('pendaftaran.')
    ->group(function () {
        Route::get('/', [PendaftaranController::class, 'index'])->name('index');
        Route::get('data', [PendaftaranController::class, 'getData'])->name('data');
        Route::post('/', [PendaftaranController::class, 'store'])->name('store');
        Route::get('{daftar}/edit', [PendaftaranController::class, 'edit'])->name('edit');
        Route::put('{daftar}', [PendaftaranController::class, 'update'])->name('update');
        Route::delete('{daftar}', [PendaftaranController::class, 'destroy'])->name('destroy');
    });
