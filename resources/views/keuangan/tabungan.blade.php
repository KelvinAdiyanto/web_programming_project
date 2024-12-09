@extends('layout')
@section('content')
    <div class="container my-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold">Tabungan</h4>

            <div class="d-flex mb-3">
                <form action="{{ route('tabungan.create') }}" method="GET">
                    <button type="submit" class="btn btn-success btn-sm">Tambah Tabungan Baru</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @empty($judul)
                    <div>Tidak ada tabungan</div>
                @else
                    <div class="table-responsive">
                        <table class="table text-center align-middle">
                            <thead class="table-success align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tabungan</th>
                                    <th>Nominal (Rp)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tabungan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>Rp. {{ number_format(intval($item->nominal), 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('tabungan.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $tabungan->links() }}
                        </div>
                    </div>
                @endempty
            </div>

            <div class="col-md-6">
                <div class="position-relative" style="height:80vh; width:100%">
                    @empty($judul)
                    @else
                        <canvas id="myChart"></canvas>
                    @endempty
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const ctx = document.getElementById('myChart');

        const data = {
            labels: @json(empty($judul) ? null : $judul),
            datasets: [{
                data: @json(empty($nominal) ? null : $nominal),
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                }
            }
        };

        new Chart(ctx, config);
    </script>
@endpush
