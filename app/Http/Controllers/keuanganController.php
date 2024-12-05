<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class keuanganController extends Controller
{
    public function catatan()
    {
        $transaksi = Transaksi::all();

        return view('keuangan.catatan', ['transaksi' => $transaksi]);
    }

    public function tabungan()
    {
        return view('keuangan.tabungan');
    }
}
