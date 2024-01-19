@extends('layout.main')
<title>Dashboard Apotek</title>
@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Apotek</h1>
    </div>

   
    <div class="row ml-2 mr-2">
        <!------------------------------------- Isi TOTAL HARIAN ----------------------------------->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3> {{ count($obat) }}</h3>

              <p> Total Obat</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/obat_page/total_stok" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
    <!------------------------------------- TOTAL Seluruh Pasien ----------------------------------->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ count($jenis) }}</h3>

              <p>Total Jenis Obat</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/jenis_obat/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
    <!------------------------------------- TOTAL Seluruh Pegawai ----------------------------------->
    {{-- <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3> {{ count($user) }}</h3>

              <p>Total Seluruh Pegawai</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
    <!------------------------------------- TOTAL Laporan Harian ----------------------------------->
    {{-- <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $laporantoday }}</h3>

              <p>Total Laporan</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
        <!-- ./col -->
      </div>


@endsection