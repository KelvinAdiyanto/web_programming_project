<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\keuanganController;
use App\Http\Controllers\KeuanganController as ControllersKeuanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('registration', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/catatan', [KeuanganController::class, 'catatan'])->middleware('auth')->name('keuangan.catatan');
Route::get('/catatan/create', [KeuanganController::class, 'createCatatan'])->middleware('auth')->name('catatan.create');
Route::post('/catatan', [KeuanganController::class, 'storeCatatan'])->middleware('auth')->name('catatan.store');
Route::post('/catatan/add-struk/{id}', [keuanganController::class, 'addStruk'])->middleware('auth')->name('keuangan.addStruk');
Route::delete('/catatan/destroy-catatan/{id}', [KeuanganController::class, 'destroyCatatan'])->name('catatan.destroy');

Route::get('/tabungan', [KeuanganController::class, 'tabungan'])->middleware('auth')->name('keuangan.tabungan');
Route::get('/tabungan/create', [KeuanganController::class, 'createTabungan'])->middleware('auth')->name('tabungan.create');
Route::post('/tabungan', [KeuanganController::class, 'storeTabungan'])->middleware('auth')->name('tabungan.store');
Route::delete('/tabungan/{id}', [KeuanganController::class, 'destroyTabungan'])->name('tabungan.destroy');

Route::get('/dompet', [ControllersKeuanganController::class, 'dompet'])->middleware('auth')->name('keuangan.dompet');
