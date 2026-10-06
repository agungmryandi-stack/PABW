<?php

use App\Http\Controllers\LokasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LokasiController::class, 'beranda']);
Route::get('/lokasi', [LokasiController::class, 'index']);
Route::get('/lokasi/{lokasi}', [LokasiController::class, 'show']);