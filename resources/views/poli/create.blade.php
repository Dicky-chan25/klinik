@extends('layout.main')
<title>Tambah Poli</title>
@section('container')

@if ($errors->any())
@foreach ($errors->all() as $item)
    <div class="alert alert-danger" role="alert">
        {{ $item }}
    </div>
@endforeach
@endif


<div class="container">
<h1>Tambah Poli</h1>
<br>
<form method="post" action="/poli/index" class="mb-5" enctype="multipart/form-data">
    @csrf
</--------------------------------------------------------Kode Obat-----------------------------------------------------------------------------------* />
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Poli</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="name" placeholder="poli obat.." required="required"
                value="{{ old('poli') }}" oninvalid="this.setCustomValidity('Poli tidak boleh kosong')" oninput="setCustomValidity('')">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="/poli/index" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</form>
</div>
</div>

@endsection