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


<div class="card">
    <div class="card-header mt-3">
    <h3>Form Tambah Poli</h3>
    </div> 
    <div class="card-body mb-5">
<form method="post" action="/poli/index" class="mb-5" enctype="multipart/form-data">
    @csrf
</--------------------------------------------------------Kode Obat-----------------------------------------------------------------------------------* />
    <div class="form-group row">
        <label class="col-sm-1 col-form-label">Poli</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="name" placeholder="poli .." required="required"
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