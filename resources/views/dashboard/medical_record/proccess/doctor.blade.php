@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Proses Rekam Medis</h1>
        <h5>Admin</h5>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medis</h6>
        </div>
        
        <div class="card-body">
            <div class="col-lg-6 mx-auto">
                <form method="POST" action="{{ route('rekammedis-submit-doctor', ['id' => $dataMr->id]) }}">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <h5>Data Admin</h5>
                        <a href="" data-toggle="collapse" data-target="#collapseAdmin">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <hr>
                    <div id="collapseAdmin" class="collapse" data-parent="#accordionSidebar">
                        <div class="form-group">
                            <label for="code">Kode Rekam Medis</label>
                            <input disabled class="form-control" value="{{ $dataMr->code }}"/>
                        </div>
                        <div class="form-group">
                            <label for="code">Nama Pasien</label>
                            <input disabled class="form-control" value="{{ $dataMr->patientName }}"/>
                        </div>
                        <div class="form-group">
                            <label for="code">Nama Layanan</label>
                            <input disabled class="form-control" value="{{ $dataMr->serviceName }}"/>
                        </div>
                        <div class="form-group">
                            <label for="code">Nama Poli</label>
                            <input disabled class="form-control" value="{{ $dataMr->poliName }}"/>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5>Data Perawat</h5>
                        <a href="" data-toggle="collapse" data-target="#collapseNurse">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <hr>
                    <div id="collapseNurse" class="collapse" data-parent="#accordionSidebar">
                        <div class="row mx-auto justify-content-between ">
                            <div class="form-group" style="width: 48%">
                                <label for="code">Berat Badan (kg)</label>
                                <input disabled class="form-control" value="{{ $dataMr->weight }}"/>
                            </div>
                            <div class="form-group" style="width: 48%">
                                <label for="code">Tinggi Badan (cm)</label>
                                <input disabled class="form-control" value="{{ $dataMr->height }}"/>
                            </div>
                        </div>
                        <div class="row mx-auto justify-content-between ">
                            <div class="form-group"  style="width: 48%">
                                <label for="code">Lingkar Pinggang</label>
                                <input disabled class="form-control" value="{{ $dataMr->waist }}"/>
                            </div>
                            <div class="form-group"  style="width: 48%">
                                <label for="code">Jenis Darah</label>
                                <input disabled class="form-control" value="{{ $dataMr->blood }}"/>
                            </div>
                        </div>

                        <p>Keluhan / Anamnesis</p>
                        <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $dataMr->complain }}</textarea>
                        <br>
                        <p>Diagnosa</p>
                        <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $dataMr->diagnose }}</textarea>
                        <br>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5>Data Dokter</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="form-group">
                            <label for="code">Nama Dokter</label>
                            <input disabled class="form-control" value="{{ Auth::user()->firstname }}"/>
                        </div>
                        <div class="form-group">
                            <label for="action">Penanganan Medis</label>
                            <textarea style="resize: none" @error('action') style="border:1px solid #ff0000;" @enderror name="action"
                                type="text" value="{{ old('action') }}" class="form-control" id="action" placeholder="action"
                                >{{ is_null(old('action')) ? $dataMr->action : old('action') }}</textarea>
                            @error('action')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="justify-content-between d-flex">
                        <button type="submit" name="type" value="0" class="btn btn-info">Simpan & Kembali</button>
                        <button type="submit" name="type" value="1" class="btn btn-primary">Simpan Submit Ke Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('dashboard.medical_record.component.table_resep')
    @include('dashboard.medical_record.component.table_inspect')
@endsection

@section('script')
    <script>
    </script>
@endsection
