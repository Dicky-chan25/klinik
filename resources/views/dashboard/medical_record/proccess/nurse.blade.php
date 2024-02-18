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
                <form method="POST" action="{{ route('rekammedis-submit-nurse', ['id' => $dataMr->id]) }}">
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
                    <br>
                    <h5>Data Rekam Medis Perawat</h5>
                    <hr>
                    {{-- form weight, height, waist, blood, anamnesis, diagnosis edit by role nurse --}}
                    <div class="row mx-auto justify-content-between ">
                        <div class="form-group">
                            <label for="weight">Berat Badan (kg)</label>
                            <input @error('weight') style="border:1px solid #ff0000;" @enderror name="weight"
                                type="number" value="{{ is_null(old('weight')) ? $dataMr->weight : old('weight') }}" class="form-control" id="weight"
                                placeholder="weight">
                            @error('weight')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="height">Tinggi Badan (cm)</label>
                            <input @error('height') style="border:1px solid #ff0000;" @enderror name="height"
                                type="number" value="{{ is_null(old('height')) ? $dataMr->height : old('height') }}" class="form-control" id="height"
                                placeholder="height">
                            @error('height')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="waist">Lingkar Pinggang</label>
                            <input @error('waist') style="border:1px solid #ff0000;" @enderror name="waist" type="number"
                                value="{{ is_null(old('waist')) ? $dataMr->waist : old('waist') }}" class="form-control" id="waist" placeholder="waist">
                            @error('waist')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="blood">Jenis Darah</label>
                            <select @error('blood') style="border:1px solid red;" @enderror class="form-control" id="blood"
                                name="blood">
                                <option value="0" disabled selected>Pilih</option>
                                @foreach ($bloods as $bl)
                                    <option value="{{ $bl->id }}" @if ($bl->title == $dataMr->blood) selected @endif>{{ $bl->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="complain">Anamnesis / Keluhan Pasien</label>
                        <textarea style="resize: none" @error('complain') style="border:1px solid #ff0000;" @enderror name="complain"
                            type="text" value="{{ old('complain') }}" class="form-control" id="complain" placeholder="complain"
                            >{{ is_null(old('complain')) ? $dataMr->complain : old('complain') }}</textarea>
                        @error('complain')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="diagnose">Diagnosis</label>
                        <textarea style="resize: none" @error('diagnose') style="border:1px solid #ff0000;" @enderror name="diagnose"
                            type="text" value="{{ old('diagnose') }}" class="form-control" id="diagnose" placeholder="diagnose"
                            >{{ is_null(old('diagnose')) ? $dataMr->diagnose : old('diagnose') }}</textarea>
                        @error('diagnose')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="doctor">Dokter Yang Menangani</label>
                        <select @error('doctor') style="border:1px solid red;" @enderror class="form-control" id="doctor"
                            name="doctor">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($doctors as $dr)
                                <option value="{{ $dr->id }}" @if ($dr->title == $dataMr->doctorName) selected @endif>{{ $dr->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="justify-content-between d-flex">
                        <button type="submit" name="type" value="0" class="btn btn-info">Simpan & Kembali</button>
                        <button type="submit" name="type" value="1" class="btn btn-primary">Simpan Submit Ke Dokter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
