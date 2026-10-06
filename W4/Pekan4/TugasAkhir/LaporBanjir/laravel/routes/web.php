<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LaporanController::class, 'beranda']);
Route::get('/form', [LaporanController::class, 'form']);
Route::post('/simpan', [LaporanController::class, 'simpan']);
Route::get('/daftar-laporan', [LaporanController::class, 'daftar']);