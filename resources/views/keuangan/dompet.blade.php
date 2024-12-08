@extends('layout')
@section('content')
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead class="table-success align-middle">
                <tr>
                    <th>No</th>
                    <th>Metode</th>
                    <th>Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($total as $metode => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $metode }}</td>
                        <td>{{ number_format(intval($item), 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Dompet kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
