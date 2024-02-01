@extends('landing-page.queue')

@section('landing-page-form-layout')
<div class="bg-q-header">
    @include('landing-page.navbar')
</div>
<div class="container-queue">
    <img class="queue-img" src="{{asset('img/checked.png')}}" alt="queue-check">
    <p class="general-title">Antrian Berhasil Dibuat</p>
    <p class="general-subtitle">Terimakasih telah melakukan submit, antrian Anda adalah :</p>
    <div class="queue-box">
        <p class="general-subtitle">Pasien Atas Nama:</p>
        <p class="general-title">{{$dataResult->patientName}}</p>
        <p class="title-queue">{{$dataResult->queue}}</p>
        <p class="general-title">{{$dataResult->patientPhone}}</p>
        <p class="general-title">{{$dataResult->doctorName}}</p>
        <p class="general-subtitle">{{$dataResult->poliName}} - {{$dataResult->serviceName}}</p>
    </div>
    <br>
    <br>
    <div class="">
        <a class="btn-primary" href="{{route('history')}}">Lihat Semua Antrian</a>
    </div>
</div>
@endsection