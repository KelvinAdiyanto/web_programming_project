<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\keuanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('/catatan', [KeuanganController::class, 'catatan'])->name('keuangan.catatan');
Route::get('/tabungan', [KeuanganController::class, 'tabungan'])->name('keuangan.tabungan');

Route::get('/dompet', [DataController::class, 'dompet'])->name('data.dompet');
Route::get('/riaway', [DataController::class, 'riwayat'])->name('data.riwayat');
