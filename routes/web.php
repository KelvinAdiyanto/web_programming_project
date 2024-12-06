<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\keuanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/catatan', [KeuanganController::class, 'catatan'])->name('keuangan.catatan');
Route::get('/tabungan', [KeuanganController::class, 'tabungan'])->name('keuangan.tabungan');
