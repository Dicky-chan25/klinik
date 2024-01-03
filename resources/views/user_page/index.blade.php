@extends('layout.main')
<title>Data User</title>
@section('container')

      @if (session()->has('success'))  
      <div class="alert alert-success col-lg-10" role="alert">
        {{ session('success') }}
      </div> 
      @endif

    <div class="col-md-8">
      <h1 class="h2">Data User</h1>
      <div class="card">
        <div class="card-header">
          <a href="/user_page/create" class="btn btn-primary mt-2 mb-2">Create new user</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->role_name }}</td>
                <td>
                  <a href="/user_page/show/{{ $user->id }}" class="badge bg-info"><i class="bi bi-eye-fill"></i></a>
                  @can('superadmin')
                  <a href="/user_page/edit/{{ $user->id }}" class="badge bg-warning"><i class="bi bi-pencil-square"></i></a>
                  @endcan
                  <a href="/user_page/delete/{{ $user->id }}" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>
                  {{-- <form action="/user_page/delete/{{ $user->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                  </form> --}}
                </td>
              </tr>
                  
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection