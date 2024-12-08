<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{

    // TODO: Move catatan to separate controller
    public function catatan(Request $request)
    {
        $user = Auth::user();

        $tanggal = $request->input('tanggal', now()->toDateString());

        $transaksi = $user->transaksi()->whereDate('tanggal_transaksi', $tanggal)->get();

        $empty = $transaksi->isEmpty();

        $total = [
            'Pemasukan' => $transaksi->where('tipe', 'Pemasukan')->sum('nominal'),
            'Pengeluaran' => $transaksi->where('tipe', 'Pengeluaran')->sum('nominal'),
        ];

        $datas = [
            'user' => $user,
            'transaksi' => $transaksi,
            'total' => $total,
            'tanggal' => $tanggal,
            'empty' => $empty
        ];

        return view('keuangan.catatan', $datas);
    }

    public function createCatatan()
    {
        return view('keuangan.addCatatan');
    }

    public function storeCatatan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'nominal' => 'required|integer|min:1',
            'metode' => 'required|string|max:255',
            'tipe' => 'required|in:Pemasukan,Pengeluaran',
            'tanggal_transaksi' => 'required|date',
        ]);

        Transaksi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'nominal' => $request->nominal,
            'metode' => $request->metode,
            'tipe' => $request->tipe,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('keuangan.catatan');
    }

    public function addStruk(Request $request, $transaksiId)
    {
        $request->validate([
            'struk' => 'required|image|mimes:jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('struk')) {
            $file = $request->file('struk');

            $fileName = time() . '-' . $file->getClientOriginalName();

            $file->move(public_path('images'), $fileName);

            $transaksi = Transaksi::findOrFail($transaksiId);
            $transaksi->struk_path = 'images/' . $fileName;
            $transaksi->save();

            return back()->with('success', 'Struk successfully uploaded!');
        }

        return back()->with('error', 'No file uploaded!');
    }

    public function tabungan()
    {
        $user = Auth::user();

        // Mengambil judul dan nominal yang dijadikan array agar bisa dibaca pie chart
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
