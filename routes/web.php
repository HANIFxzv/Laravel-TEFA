<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SiswaController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
route::post('/authenticate', [LoginRegisterController::class, 'store'])->name('store');
// Rute untuk pengguna yang belum terautentikasi
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/siswa', SiswaController::class); // Rute resource untuk siswa
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});

// Rute untuk pengguna yang terautentikasi dan admin
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/siswa', SiswaController::class); // Rute resource untuk siswa
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});