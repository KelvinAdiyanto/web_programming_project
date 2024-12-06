@extends('layout')
@section('content')
    <div>
        <h5 class="fw-semibold">Aplikasi Lainnya</h5>
        <h6><a href="{{ route('keuangan.catatan') }}">Catatan Keuangan</a></h6>
        <h6><a href="{{ route('keuangan.tabungan') }}">Tabungan</a></h6>
        <h6><a href="{{ route('data.dompet') }}">Dompet</a></h6>
        <h6><a href="{{ route('data.riwayat') }}">Riwayat</a></h6>
    </div>
@endsection
