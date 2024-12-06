<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Programming</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="py-3 fw-bold"><a href="{{ route('dashboard') }}">FinAlly.</a></h3>
            </div>
        </div>
        <div class="row">
            <div class="col">@yield('content')</div>
        </div>
    </div>
</body>

<script src="{{ asset('js/boostrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('script')

</html>
