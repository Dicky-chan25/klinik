@extends('layout.main')
<title>Edit user {{ $user->name }}</title>
@section('container')




    <div class="card">
        <div class="card-header mt-3">
        <h3>Edit user {{ $user->name }}</h3>
        </div> 
        <div class="card-body mb-5">
            <form method="post" action="/user_page/update/{{ $user->id }}" class="mb-5" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-5">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                name="name" required autofocus value="{{ old('name', $user->name) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

                <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" required value="{{ old('email', $user->email) }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

                <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-5">
                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required value="{{ old('password', $user->password) }}">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role Id</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control @error('role_id') is-invalid @enderror" id="role_id"
                    name="role_id" required  value="{{ old('role_id', $user->role_id) }}">
                    @error('role_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
            
                <a href="/user_page/index" class="btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>
    
@endsection