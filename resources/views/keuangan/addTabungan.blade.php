@extends('layout')
@section('content')
    <div class="container my-4">
        <h4 class="fw-bold text-center mb-4">Tambah Tabungan</h4>

        <form action="{{ route('tabungan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Tabungan</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                    value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal (Rp)</label>
                <input type="number" step="0.001" class="form-control @error('nominal') is-invalid @enderror"
                    id="nominal" name="nominal" value="{{ old('nominal') }}" required>
                @error('nominal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Tambah Tabungan</button>
            </div>
        </form>
    </div>
@endsection
