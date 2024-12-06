@extends('layout')
@section('content')
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead class="table-success align-middle">
                <tr>
                    <th>No</th>
                    <th>Metode</th>
                    <th>Nominal (Rp)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($total as $metode => $total)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $metode }}</td>
                        <td>{{ number_format(intval($total), 0, ',', '.') }}</td>
                        <td>></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
