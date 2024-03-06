@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pasien</h1>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil Pasien</h6>
            {{-- <h6 class="m-0 font-weight-bold text-primary">{{$detailPatient}}</h6> --}}
        </div>
        <div class="card-body">
            <div class="m-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->patientName }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->email }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>NIK</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->identity }}"
                                input>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nomor BPJS</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->bpjs }}"
                                input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tempat/Tgl Lahir</label>
                            <input class="form-control" type="text" disabled
                                value="{{ $detailPatient->birthplace . '/' . $detailPatient->birthdate }}" input>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nomor Telpon</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->phone }}" input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Gender</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->gender }}" input>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Agama</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->religion }}"
                                input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->career }}" input>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input class="form-control" type="text" disabled value="{{ $detailPatient->education }}"
                                input>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mr-1 mt-4">
                    <div class=""></div>
                    <a class="btn btn-primary text-white ">Tambah Rekam Medis</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekam Medis</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Rekam Medis</th>
                            <th>Tanggal Periksa</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailMr as $mr)
                            <tr>
                                <td>{{ $mr->rm_code }}</td>
                                <td>{{ date('d-m-Y', strtotime($mr->created_at)) }}</td>
                                <td>{{ $mr->complaint  == '' ? 'Belum Ada' : $mr->complaint }}</td>
                                <td>{{ $mr->diagnose  == '' ? 'Belum Ada' : $mr->diagnose}}</td>
                                <td>{{ $mr->information  == '' ? 'Belum Ada' : $mr->action }}</td>
                                <td>
                                    <a href="#" class="btn btn-info">
                                        <i class="fas fa-list"></i>
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
