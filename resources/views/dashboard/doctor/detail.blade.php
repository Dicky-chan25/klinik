@extends('dashboard-layout.main')

@section('dashboard')
    @include('dashboard.doctor.component.modal_schedule_delete')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Dokter</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Profil Dokter</h6>
        </div>
        <div class="card-body">
            <div class="m-4">
                <div style="display: flex; align-items:center">
                    <img style="width: 200px;height:200px;object-fit: contain" class="img-thumbnail rounded-circle mb-2"
                        src="{{ asset('img/doctor/' . $detailData->pic) }}" alt="{{ $detailData->pic }}">
                    <div class="col ml-4">
                        <h3 class="text-primary">{{ $detailData->name }}</h3>
                        <p>{{ $detailData->spTitle }}</p>
                        <h5 style="margin-top:-10px;">Komisi Konsultasi : Rp. {{ number_format($detailData->price) }}</h5>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>NIK</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->identity }}" input>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>STR</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->str }}" input>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>SIP</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->sip }}" input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Kode Pegawai</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->code }}" input>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->birthplace }}"
                                input>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->birthdate }}" input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nomor Telpon</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->phone }}" input>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" disabled value="{{ $detailData->email }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" type="text" disabled value="{{ $detailData->address }}" input>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jadwal Praktek</h6>
                </div>
                <div class="card-body">
                    <a href=""  data-target="#scModal" data-toggle="modal">
                        <div class="btn btn-primary btn-sm mb-4">
                            Tambah Jadwal Praktek
                        </div>
                    </a>
                    @include('dashboard.doctor.component.modal_schedule_create')
                    <div class="table-responsive table-sm">
                        <table class="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam Awal</th>
                                    <th>Jam Akhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedule as $scd)
                                <tr>
                                    <td>
                                        {{$scd->dayTitle}}
                                    </td>
                                    <td>{{$scd->timefrom}}</td>
                                    <td>{{$scd->timeto}}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger data-delete" data-target="#deleteSc" data-toggle="modal" 
                                        data-delid="{{$scd->id}}">
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
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tentang Dokter</h6>
                </div>
                <div class="card-body">
                    <p>{{$detailData->about}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // var readValue;
        // var createValue;
        // var editValue;
        // var deleteValue;
        // var levelId = window.location.href.split('/').reverse()[0];

        // $(".read-onclick").change(function() {
        //     readValue = $(this).attr("data-readvalue");
        //     var id = $(this).data("accessid")
        //     window.location.href = '/settings/userlevels/detail/' + id + '/read/' + readValue;
        // });
        // $(".create-onclick").change(function() {
        //     createValue = $(this).attr("data-createvalue");
        //     var id = $(this).data("accessid")
        //     window.location.href = '/settings/userlevels/detail/' + id + '/create/' + createValue;
        // });
        // $(".edit-onclick").change(function() {
        //     editValue = $(this).attr("data-editvalue");
        //     var id = $(this).data("accessid")
        //     window.location.href = '/settings/userlevels/detail/' + id + '/edit/' + editValue;
        // });
        // $(".delete-onclick").change(function() {
        //     deleteValue = $(this).attr("data-deletevalue");
        //     var id = $(this).data("accessid")
        //     window.location.href = '/settings/userlevels/detail/' + id + '/delete/' + deleteValue;
        // });
        $(".data-delete").on('click', function() {
            id = $(this).data("delid");
            $("#delete-data-name").text('Apakah Anda yakin ingin menghapus jadwal ini ?');
        });
        // submit delete function
        $(".submit-delete").on('click', function() {
            window.location.href='/dokter/delete/'+id+'/schedule'
        });
    </script>
@endsection
