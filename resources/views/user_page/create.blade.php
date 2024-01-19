@extends('layout.main')
<title>Create User</title>
@section('container')


    <div class="card">
        <div class="card-header mt-3">
        <h3>Form Tambah User</h3>
        </div> 
        <div class="card-body mb-5">
            <form method="post" action="/user_page/index" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                name="name" required autofocus value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" required value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required value="{{ old('password') }}">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="rle_id" class="form-label"></label>
                <input type='hidden' class="form-control" id="role_id"
                name="role_id" required value='3'>
                </div>
                <a href="/user_page/index" class="btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>

    </div>
@endsection