<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebandooController;

Route::get('/', [WebandooController::class, 'beranda']);
Route::get('/peta', [WebandooController::class, 'peta']);
Route::get('/edukasi', [WebandooController::class, 'edukasi']);
Route::get('/event', [WebandooController::class, 'event']);
Route::get('/kuliner', [WebandooController::class, 'kuliner']);
Route::get('/sejarah', [WebandooController::class, 'sejarah']);