@extends('layout')
@section('content')
    <div class="position-relative" style="height:80vh; width:80vw">
        <canvas id="myChart"></canvas>
    </div>
@endsection

@push('script')
    <script>
        const ctx = document.getElementById('myChart');

        const data = {
            labels: @json($judul),
            datasets: [{
                data: @json($nominal),
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
