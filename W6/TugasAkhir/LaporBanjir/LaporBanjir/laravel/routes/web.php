<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::pattern('role', 'petugas|admin');
// ===== Halaman PUBLIK (warga, tanpa login) =====
Route::get('/form', [LaporanController::class, 'form']);
Route::post('/simpan', [LaporanController::class, 'simpan']);
// ===== Login & Register (hanya untuk yang BELUM login) =====
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => redirect('/login/petugas'))->name('login');
    Route::get('/login/{role}', [LoginController::class, 'formLogin']);
    Route::post('/login/{role}', [LoginController::class, 'prosesLogin']);

    Route::get('/register', fn () => redirect('/register/petugas'))->name('register');
    Route::get('/register/{role}', [RegisterController::class, 'formRegister']);
    Route::post('/register/{role}', [RegisterController::class, 'prosesRegister']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// ===== Halaman yang WAJIB LOGIN (admin dan petugas) =====
Route::middleware('auth')->group(function () {
    Route::get('/', [LaporanController::class, 'beranda']);
    Route::get('/daftar-laporan', [LaporanController::class, 'daftar']);
    Route::get('/profil', fn () => view('profil'));
    // ===== Halaman khusus ADMIN =====
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/petugas', [AdminController::class, 'petugas']);
        Route::delete('/admin/petugas/{id}', [AdminController::class, 'hapus']);
    });
});
