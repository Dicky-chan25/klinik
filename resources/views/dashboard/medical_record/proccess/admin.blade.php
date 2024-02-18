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
                <form method="POST" action="{{ route('rekammedis-submit-admin', ['id' => $dataMr->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="code">Kode Rekam Medis</label>
                        <div class="form-control">{{ $dataMr->code }}</div>
                    </div>
                    <div class="form-group" id="disablePatientName">
                        <label for="code">Nama Pasien</label>
                        <div class="form-control">{{ $dataMr->patientName }}</div>
                        <div class="btn btn-primary mt-2 change-patient">Ubah Nama Pasien</div>
                    </div>
                    <div class="form-group" id="enablePatientName">
                        <label for="patient">Pilih Pasien</label>
                        <livewire:dropdown-patient>
                    </div>
                    <div class="row mx-auto justify-content-between ">
                        <div class="form-group" style="width: 49%">
                            <label for="service">Pilih Layanan</label>
                            <select @error('service') style="border:1px solid red;" @enderror class="form-control"
                                id="service" name="service">
                                <option value="0" disabled selected>Pilih</option>
                                @foreach ($services as $ser)
                                    <option value="{{ $ser->id }}"
                                        @if ($ser->title == $dataMr->serviceName) selected @endif
                                    >{{ $ser->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="width: 49%">
                            <label for="poli">Jenis Poli</label>
                            <select @error('poli') style="border:1px solid red;" @enderror class="form-control"
                                id="poli" name="poli">
                                <option value="0" disabled selected>Pilih</option>
                                @foreach ($polis as $po)
                                    <option value="{{ $po->id }}"
                                        @if ($po->title == $dataMr->poliName) selected @endif
                                    >{{ $po->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="justify-content-between d-flex">
                        <button type="submit" name="type" value="0" class="btn btn-info">Simpan & Kembali</button>
                        <button type="submit" name="type" value="1" class="btn btn-primary">Simpan Submit Ke Perawat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        // switch name
        $("#disablePatientName").show();
        $("#enablePatientName").hide();

        $(".change-patient").on('click', function() {
            $("#disablePatientName").hide();
            $("#enablePatientName").show();
        });
    </script>
@endsection
