@extends('layout')
@section('content')
    <div class="container mb-4">
        <h2 class="mb-4">Tambah Transaksi</h2>
        <form action="{{ route('catatan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Transaksi</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori') }}"
                    required>
                @error('kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal (Rp)</label>
                <input type="number" class="form-control" id="nominal" name="nominal" value="{{ old('nominal') }}"
                    required>
                @error('nominal')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="metode" class="form-label">Metode</label>
                <input type="text" class="form-control" id="metode" name="metode" value="{{ old('metode') }}"
                    required>
                @error('metode')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <select class="form-select" id="tipe" name="tipe" required>
                    <option value="" disabled selected>Pilih Tipe</option>
                    <option value="Pemasukan" {{ old('tipe') == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="Pengeluaran" {{ old('tipe') == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
                @error('tipe')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                    value="{{ old('tanggal_transaksi') }}" required>
                @error('tanggal_transaksi')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
