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

        <div class="d-flex mb-3">
            <form action="{{ route('catatan.create') }}" method="GET">
                <button type="submit" class="btn btn-success btn-sm">Tambah Transaksi Baru</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table text-center align-middle">
                <thead class="table-success align-middle">
                    <tr id="tableHeader">
                        <th>No</th>
                        <th>Judul Transaksi</th>
                        <th>Kategori</th>
                        <th>Nominal (Rp)</th>
                        <th>Tipe</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $item)
                        <tr id="tableData">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ number_format(intval($item->nominal), 0, ',', '.') }}</td>
                            <td>{{ $item->tipe }}</td>
                            <td>
                                <button type="button" class="btn btn-success fw-bold transaksi-detail-btn"
                                    data-id="{{ $item->id }}" data-struk="{{ $item->struk_path ?? '' }}">></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $transaksi->appends(['tanggal' => request('tanggal')])->links() }}
            </div>
        </div>
    </div>

    <div class="position-fixed top-50 start-50 bg-white translate-middle p-4 shadow rounded" id="transaksiDetailDiv"
        style="z-index: 1050; max-width: 400px; width: 100%; display: none;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0"><span class="fw-bold" id="transaksiTitle"></span></h5>
            <button type="button" class="btn-close" onclick="closeDiv()"></button>
        </div>

        <div id="transaksiDetail"></div>

        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="fileUpload" class="form-label fw-semibold">Tambah Struk</label>
                <input type="file" class="form-control mb-3" name="struk">
                <button type="submit" class="btn btn-primary">Upload Gambar</button>
            </div>
        </form>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="mt-1">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        const tanggalForm = document.getElementById('tanggalForm');
        document.getElementById('tanggalInput').addEventListener('change', function() {
            tanggalForm.submit();
        });

        document.querySelectorAll('.transaksi-detail-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                data = this.closest("tr");
                header = document.getElementById('tableHeader');

                document.getElementById('transaksiTitle').innerText = data.cells[1].innerText;

                var transaksiDetail = document.getElementById("transaksiDetail");
                transaksiDetail.innerHTML = '';

                for (var i = 2; i <= 4; i++) {
                    var p = document.createElement("p");
                    p.innerHTML = "<span class='fw-semibold'>" + header.cells[i].innerHTML + "</span>: " +
                        data.cells[i]
                        .innerText;
                    transaksiDetail.appendChild(p);
                }

                const transactionId = this.getAttribute('data-id');
                const uploadForm = document.getElementById('uploadForm');
                if (uploadForm) {
                    uploadForm.action = `/catatan/add-struk/${transactionId}`;
                }

                const deleteForm = document.getElementById('deleteForm');
                if (deleteForm) {
                    deleteForm.action = `/catatan/destroy-catatan/${transactionId}`;
                }

                const strukPath = this.getAttribute('data-struk');
                if (strukPath) {
                    const img = document.createElement("img");
                    img.src = strukPath;
                    img.alt = "Tidak ada struk";
                    img.className = "img-fluid mt-3";
                    transaksiDetail.appendChild(img);
                }

                document.getElementById('transaksiDetailDiv').style.display = 'block';
            });
        });

        function closeDiv() {
            document.getElementById('transaksiDetailDiv').style.display = 'none';
        }
    </script>
@endpush
