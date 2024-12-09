<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
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

        $allTransaksi = $user->transaksi()->whereDate('tanggal_transaksi', $tanggal)->get();

        $transaksi = $user->transaksi()->whereDate('tanggal_transaksi', $tanggal)->paginate(5);

        $total = [
            'Pemasukan' => $allTransaksi->where('tipe', 'Pemasukan')->sum('nominal'),
            'Pengeluaran' => $allTransaksi->where('tipe', 'Pengeluaran')->sum('nominal'),
        ];

        $datas = [
            'user' => $user,
            'transaksi' => $transaksi,
            'total' => $total,
            'tanggal' => $tanggal,
            'empty' => $allTransaksi->isEmpty()
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

        $transaksi = Transaksi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'nominal' => $request->nominal,
            'metode' => $request->metode,
            'tipe' => $request->tipe,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'user_id' => Auth::id(),
        ]);

        $user = Auth::user();

        if ($transaksi->tipe === 'Pemasukan') {
            $user->saldo_total += $transaksi->nominal;
        } else {
            $user->saldo_total -= $transaksi->nominal;
        }
        $user->save();

        return redirect()->route('keuangan.catatan')->withSuccess('Transaksi berhasil ditambahkan');
    }

    public function destroyCatatan($id)
    {
        $user = Auth::user();
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->tipe === 'Pemasukan') {
            $user->saldo_total -= $transaksi->nominal;
        } else {
            $user->saldo_total += $transaksi->nominal;
        }
        $user->save();

        $transaksi->delete();

        return redirect()->route('keuangan.catatan')->withSuccess('Transaksi berhasil dihapus');
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

            return back()->withSuccess('Struk berhasil di upload!');
        }

        return back()->withErrors('File gagal di upload!');
    }

    public function tabungan()
    {
        $user = Auth::user();

        $tabungan = $user->tabungan()->paginate(5);

        // Mengambil judul dan nominal yang dijadikan array agar bisa dibaca pie chart
        if ($tabungan->isNotEmpty()) {
            foreach ($user->tabungan as $item) {
                $judul[] = $item->judul;
                $nominal[] = $item->nominal;
            }
        }

        $datas = [
            'tabungan' => $tabungan,
            'judul' => $judul,
            'nominal' => $nominal
        ];

        return view('keuangan.tabungan', $datas);
    }

    public function createTabungan()
    {
        return view('keuangan.addTabungan');
    }

    public function storeTabungan(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        Tabungan::create([
            'judul' => $validated['judul'],
            'nominal' => $validated['nominal'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('keuangan.tabungan')->withSuccess('Tabungan berhasil ditambahkan.');
    }

    public function destroyTabungan($id)
    {
        $tabungan = Tabungan::findOrFail($id);

        if ($tabungan->user_id !== Auth::id()) {
            return redirect()->route('keuangan.tabungan')->withError('Anda tidak memiliki izin untuk menghapus tabungan ini');
        }

        $tabungan->delete();

        return redirect()->route('keuangan.tabungan')->withSuccess('Tabungan berhasil dihapus');
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
