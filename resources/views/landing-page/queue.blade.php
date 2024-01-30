<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Praktik Mandiri Dokter Asep</title>
    <link rel="stylesheet" href="{{ asset('css/landingpage/index.css') }}">
</head>

<body>
    <div class="ribbon-info">
        <p>Selected clinic <strong style="font-family: 'PoppinsMedium' !important">OPEN ON SUNDAY</strong>. Book
            Appointment Now</p>
    </div>

    @yield('landing-page-form-layout')

    <div class="bg-header">
        @include('landing-page.footer')
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@yield('script')
</html>
