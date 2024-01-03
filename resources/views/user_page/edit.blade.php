@extends('layout.main')
<title>Edit user {{ $user->name }}</title>
@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ml-2 pt-3 pb-2 mb-3">
        <h1 class="h2">Edit user {{ $user->name }}</h1>
    </div>



        <div class="col-lg-8">
            <form method="post" action="/user_page/update/{{ $user->id }}" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                name="name" required autofocus value="{{ old('name', $user->name) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" required value="{{ old('email', $user->email) }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required value="{{ old('password', $user->password) }}">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Role Id</label>
                    <input type="text" class="form-control @error('role_id') is-invalid @enderror" id="role_id"
                    name="role_id" required  value="{{ old('role_id', $user->role_id) }}">
                    @error('role_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
            

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>
    
@endsection