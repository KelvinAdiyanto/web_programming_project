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
}
