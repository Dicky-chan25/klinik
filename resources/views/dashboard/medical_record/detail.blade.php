@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Rekam Medis</h1>
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
    @if ($err = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <span class="text-sm">{{ $err }}</span>
        </div>
    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="p-4">
            <a href="">
                <div class="btn btn-info">Lihat Tagihan</div>
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Resep Obat</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                {{-- <div class=""></div> --}}
                <a href="{{ route('rekammedis-create-resep', ['id' => $idMr]) }}">
                    <div class="btn btn-primary">Tambah Resep Obat</div>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Resep</th>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Umur</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Dibuat Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allPrescription as $ap)
                            <tr>
                                <td>{{ $ap->resepCode }}</td>
                                <td>{{ $ap->nameMedicine }}</td>
                                <td>{{ $ap->category }}</td>
                                <td>{{ $ap->ageName }}</td>
                                <td>{{ $ap->qty }}</td>
                                <td>{{ $ap->info }}</td>
                                <td>{{ date('d-m-Y', strtotime($ap->createdAt)) }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lihat Pemeriksaan Lanjutan</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                {{-- <div class=""></div> --}}
                <a href="{{ route('rekammedis-create-inspect', ['id' => $idMr]) }}">
                    <div class="btn btn-primary">Buat Pemeriksaan Lanjutan</div>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Resep</th>
                            <th>Nama Pemeriksaan</th>
                            <th>Biaya</th>
                            <th>Keterangan</th>
                            <th>Dibuat Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allInspect as $ai)
                            <tr>
                                <td>{{ $ai->ispCode }}</td>
                                <td>{{ $ai->ispName }}</td>
                                <td>Rp. {{ number_format($ai->price) }}</td>
                                <td>{{ $ai->info }}</td>
                                <td>{{ date('d-m-Y', strtotime($ai->createdAt)) }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var readValue;
        var createValue;
        var editValue;
        var deleteValue;
        var levelId = window.location.href.split('/').reverse()[0];

        $(".read-onclick").change(function() {
            readValue = $(this).attr("data-readvalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/read/' + readValue;
        });
        $(".create-onclick").change(function() {
            createValue = $(this).attr("data-createvalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/create/' + createValue;
        });
        $(".edit-onclick").change(function() {
            editValue = $(this).attr("data-editvalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/edit/' + editValue;
        });
        $(".delete-onclick").change(function() {
            deleteValue = $(this).attr("data-deletevalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/delete/' + deleteValue;
        });
    </script>
@endsection
