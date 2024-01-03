@extends('layout.main')
<title>Dashboard Obat</title>
@section('container')

@if ($errors->any())
@foreach ($errors->all() as $item)
    <div class="alert alert-danger" role="alert">
        {{ $item }}
    </div>
@endforeach
@endif


<div class="container">
<h1>Pilihan Baru untuk Jenis Obat</h1>
<br>
<form method="post" action="/jenis_obat/index" class="mb-5" enctype="multipart/form-data">
    @csrf
</--------------------------------------------------------Kode Obat-----------------------------------------------------------------------------------* />
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis Obat</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="jenis" placeholder="Jenis obat.." required="required"
                value="{{ old('jenis') }}" oninvalid="this.setCustomValidity('Kode obat tidak boleh kosong')" oninput="setCustomValidity('')">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="/jenis_obat/index" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</form>
</div>
</div>

@endsection