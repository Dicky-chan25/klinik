<title>Ubah Poli/Spesialis</title>
@extends('layout.main')
@section('container')

    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <div class="alert alert-danger" role="alert">
                {{ $item }}
            </div>
        @endforeach

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    @endif
    <div class="card">
        <div class="card-header mt-3">
        <h3>Form Edit Poli</h3>
        </div> 
        <div class="card-body mb-5">
        <form action="/poli/update/{{ $poli->id }}" method="post" enctype="multipart/form-data">
            @csrf

            </--------------------------------------------------------Poli lama-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Poli / Spesialis Sebelumnya</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control"
                        value="{{ $poli->name }}" readonly>
                </div>
            </div>
            </--------------------------------------------------------Poli baru-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Perubahan Poli / Spesialis</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control @error('Poli') is-invalid @enderror" name="name"
                        placeholder="tuliskan perubahan poli..." value="{{ $poli->name }}" required oninvalid="this.setCustomValidity('isi poli terbaru')" oninput="setCustomValidity('')">
                    
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a href="/poli/index" class="btn btn-warning">Kembali</a>
                </div>
            </div>

        </form>
</body>

</html>
@endsection