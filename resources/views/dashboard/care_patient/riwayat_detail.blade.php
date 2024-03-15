@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Perawatan Pasien</h1>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if ($err = Session::get('err'))
        <div class="alert alert-danger" role="alert">
            <span class="text-sm">{{ $err }}</span>
        </div>
    @endif
    
    @include('dashboard.care_patient.component.riwayat_detail.header')
    @include('dashboard.care_patient.component.assesment.table_result')
    @include('dashboard.care_patient.component.obat_racik.table_result')
    @include('dashboard.care_patient.component.obat_nonracik.table_result')
    @include('dashboard.care_patient.component.tindakan.table_result')
    @include('dashboard.care_patient.component.laborat.table_result')

    <div class="card shadow mb-4 p-4">
        <div class=" d-flex justify-content-between">
            <h5 class="text-primary">Total Billing</h5>
            <h2 class="text-danger">1.500.000</h2>
        </div>
    </div>

@endsection