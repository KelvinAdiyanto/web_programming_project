<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function dompet()
    {
        return view('data.dompet');
    }

    public function riwayat()
    {
        return view('data.riwayat');
    }
}
