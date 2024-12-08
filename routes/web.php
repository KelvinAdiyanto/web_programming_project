<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\keuanganController;
use App\Http\Controllers\KeuanganController as ControllersKeuanganController;
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
Route::get('/catatan/create', [KeuanganController::class, 'createCatatan'])->name('catatan.create');
Route::post('/catatan', [KeuanganController::class, 'storeCatatan'])->name('catatan.store');
Route::post('/catatan/add-struk/{id}', [keuanganController::class, 'addStruk'])->name('keuangan.addStruk');

Route::get('/tabungan', [KeuanganController::class, 'tabungan'])->name('keuangan.tabungan');
Route::get('/tabungan/create', [KeuanganController::class, 'createTabungan'])->name('tabungan.create');
Route::post('/tabungan', [KeuanganController::class, 'storeTabungan'])->name('tabungan.store');

Route::get('/dompet', [ControllersKeuanganController::class, 'dompet'])->name('keuangan.dompet');
