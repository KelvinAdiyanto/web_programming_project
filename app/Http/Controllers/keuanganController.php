<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function catatan()
    {
        $user = Auth::user();
        $transaksi = $user->transaksi;

        $datas = [
            'user' => $user,
            'transaksi' => $transaksi
        ];

        return view('keuangan.catatan', $datas);
    }

    public function tabungan()
    {
        $user = Auth::user();
        foreach ($user->tabungan as $tabungan) {
            $judul[] = $tabungan->judul;
            $nominal[] = $tabungan->nominal;
        }

        $datas = [
            'judul' => $judul,
            'nominal' => $nominal
        ];

        return view('keuangan.tabungan', $datas);
    }

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

        return view('keuangan.dompet', ['total' => $total]);
    }
}
