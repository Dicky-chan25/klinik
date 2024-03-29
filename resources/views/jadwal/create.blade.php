<title>Jadwal Praktek Baru</title>
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
        <h3>Jadwal Praktek Baru</h3>
        </div> 
        <div class="card-body mb-5">
        <form action="/jadwal/index" method="post">
            @csrf
            
        </--------------------------------------------------------Jadwal Praktek-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jadwal Praktek</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control @error('Jadwal') is-invalid @enderror" name="Jadwal"
                        placeholder="tuliskan jadwal..." value="{{ old('Jadwal') }}">
                    @error('Jadwal')
                        <div class="invalid-feedback">
                            "Jadwal masih kosong
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="/jadwal/index" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection