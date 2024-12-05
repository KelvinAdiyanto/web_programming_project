<?php

use App\Http\Controllers\keuanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/catatan', [keuanganController::class, 'catatan'])->name('keuangan.catatan');
Route::get('/tabungan', [keuanganController::class, 'tabungan'])->name('keuangan.tabungan');
