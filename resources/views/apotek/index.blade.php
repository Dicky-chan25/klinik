@extends('layout.main')
<title>Dashboard Apotek</title>
@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Apotek</h1>
    </div>

    <div class="container">
        <h2>Selamat Datang Apoteker</h2>
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>
    </div>

@endsection