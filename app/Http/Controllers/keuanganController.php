<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class keuanganController extends Controller
{
    public function catatan()
    {
        return view('keuangan.catatan');
    }

    public function tabungan()
    {
        return view('keuangan.tabungan');
    }
}
