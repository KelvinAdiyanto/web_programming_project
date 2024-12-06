<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function dompet()
    {
        $user = Auth::user();
        $transaksi = $user->transaksi;

        $total = [];

        // TODO: Limit tanggal transaksi utk mengurangi waktu looping
        // Mengambil total pemasukan - total pengeluaran dari setiap metode yang digunakan
        foreach ($transaksi as $transaksi) {
            if (!isset($total[$transaksi->metode])) {
                $total[$transaksi->metode] = 0;
            }

            if ($transaksi->tipe == 'Pemasukan') {
                $total[$transaksi->metode] += $transaksi->nominal;
            } elseif ($transaksi->tipe == 'Pengeluaran') {
                $total[$transaksi->metode] -= $transaksi->nominal;
            }
        }

        return view('data.dompet', ['total' => $total]);
    }

    public function riwayat()
    {
        return view('data.riwayat');
    }
}
