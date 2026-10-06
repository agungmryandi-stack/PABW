<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

Route ::get('/', function () {
    return redirect()->route('laporan.form');
});

Route::get('/lapor', [LaporanController::class, 'form'])->name('laporan.form');
Route::post('/lapor', [LaporanController::class, 'kirim'])->name('laporan.kirim');