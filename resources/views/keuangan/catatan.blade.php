@extends('layout')
@section('content')
    <div class="container my-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Catatan Keuangan</h4>
            <p class="text-muted">Senin, 21 Oktober 2024</p>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col">
                        <h6 class="fw-bold">Saldo</h6>
                        <p class="fs-5">Rp. 15.000.000</p>
                    </div>
                    <div class="col">
                        <h6 class="fw-bold">Pendapatan</h6>
                        <p class="fs-5 text-success">Rp. 100.000</p>
                    </div>
                    <div class="col">
                        <h6 class="fw-bold">Pengeluaran</h6>
                        <p class="fs-5 text-danger">Rp. 365.000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-success btn-sm">Tambah Tabungan Baru</button>
            <button class="btn btn-danger btn-sm">Unduh .pdf</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Judul Transaksi</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaksi->judul }}</td>
                            <td>{{ $transaksi->kategori }}</td>
                            <td>{{ number_format(intval($transaksi->nominal), 0, ',', '.') }}</td>
                            <td>{{ $transaksi->tipe }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
