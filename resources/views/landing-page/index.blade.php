<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Praktik Mandiri Dokter Asep</title>
    <link rel="stylesheet" href="{{ asset('css/landingpage/index.css') }}">
    <!-- UIkit CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" /> --}}

</head>
<body>
    <div class="ribbon-info">
        <p>Selected clinic <strong style="font-family: 'PoppinsMedium' !important">OPEN ON SUNDAY</strong>. Book Appointment Now</p>
    </div>
    <div class="bg-header">
        @include('landing-page.navbar')
        @include('landing-page.header')
        @include('landing-page.about')
    </div>

    @include('landing-page.consultation')
    
    <div class="bg-header">
        @include('landing-page.footer')
    </div>
</body>
<!-- UIkit JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script> --}}

</html>