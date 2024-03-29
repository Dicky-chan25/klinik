<title>Dokter : {{ $dokter->nama }}</title>
@extends('layout.main')
@section('container')

    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <div class="alert alert-danger" role="alert">
                {{ $item }}
            </div>
        @endforeach

    @endif
    <div class="card">
        <div class="card-header mt-3">
        <h3>Edit Data Dokter</h3>
        </div>
        <div class="card-body mb-5">
        <form action="/dokter_page/update/{{ $dokter->id }}" method="post" enctype="multipart/form-data">
            @csrf

            </--------------------------------------------------------Nama-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Nama" placeholder="Nama" required="required"
                        value="{{ $dokter->nama }}" oninvalid="this.setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')">
                </div>
            </div>
            </--------------------------------------------------------Alamat-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Alamat" placeholder="Alamat"
                        value="{{ $dokter->alamat }}">
                </div>
            </div>


            </--------------------------------------------------------Spesialis-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Spesialis</label>
                <div class="col-sm-5">
                    <select name="Spesialis" class="form-control" value="{{ $dokter->poli->name ?? "-" }}">
                        <option selected value="">pilih poli / spesialis</option>
                        @foreach($poli as $p)
                            <option value="{{ $p->id }}">{{ $p->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            </--------------------------------------------------------Telepon-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="notelp" name="Telepon"
                        placeholder="Nomer Telepon (aktif)" value="{{ $dokter->telepon }}">
                </div>
            </div>


            </--------------------------------------------------------Jadwal lama-----------------------------------------------------------------------------------* />

            <div class="form group row">
                <label class="col-sm-2 col-form-label">Jadwal Praktek Lama</label>
                <div class="col-sm-5">
                    <input class="form-control" value="{{ $dokter->jadwal->jadwalpraktek ?? "-" }}" readonly>
                </div>
            </div>
<br>
        </--------------------------------------------------------Jadwal baru-----------------------------------------------------------------------------------* />
            <div class="form group row">
                <label class="col-sm-2 col-form-label">Jadwal Praktek Baru</label>
                <div class="col-sm-5">
                    <select name="Jadwal" class="form-control" value="{{ $dokter->jadwal->jadwalpraktek ?? "-"}}"
                        required oninvalid="this.setCustomValidity('Pilih Jadwal Praktek')" oninput="setCustomValidity('')">
                        <option selected value="">tentukan jadwal praktek baru...</option>
                        @foreach ($jadwalvariabel as $jadwal)
                            <option value="{{ $jadwal->id }}">{{ $jadwal->jadwalpraktek }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="/dokter_page/index" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection