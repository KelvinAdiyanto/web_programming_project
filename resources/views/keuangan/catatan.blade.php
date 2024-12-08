@extends('layout')
@section('content')
    <div class="container my-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Catatan Keuangan</h4>

            <form action="{{ route('keuangan.catatan') }}" method="GET" class="d-inline-block" id="tanggalForm">
                <input type="date" name="tanggal" value="{{ request('tanggal') ?? now()->toDateString() }}"
                    class="form-control d-inline-block w-auto" id="tanggalInput">
            </form>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col">
                        <h6 class="fw-bold">Saldo</h6>
                        <p class="fs-5">Rp. {{ number_format(intval($user->saldo_total), 0, ',', '.') }}</p>
                    </div>
                    <div class="col">
                        <h6 class="fw-bold">Pendapatan</h6>
                        <p class="fs-5 text-success">Rp. {{ number_format(intval($total['Pemasukan']), 0, ',', '.') }}</p>
                    </div>
                    <div class="col">
                        <h6 class="fw-bold">Pengeluaran</h6>
                        <p class="fs-5 text-danger">Rp. {{ number_format(intval($total['Pengeluaran']), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-success btn-sm">Tambah Catatan Baru</button>
            <button class="btn btn-danger btn-sm">Unduh .pdf</button>
        </div>

        <div class="table-responsive">
            <table class="table text-center align-middle">
                <thead class="table-success align-middle">
                    <tr>
                        <th>No</th>
                        <th>Judul Transaksi</th>
                        <th>Kategori</th>
                        <th>Nominal (Rp)</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ number_format(intval($item->nominal), 0, ',', '.') }}</td>
                            <td>{{ $item->tipe }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const myForm = document.getElementById('tanggalForm');
        document.getElementById('tanggalInput').addEventListener('change', function() {
            myForm.submit();
        });
    </script>
@endpush
