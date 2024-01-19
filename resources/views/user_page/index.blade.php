@extends('layout.main')
<title>Data User</title>
@section('container')

      @if (session()->has('success'))  
      <div class="alert alert-success col-lg-10" role="alert">
        {{ session('success') }}
      </div> 
      @endif


<div class="card">
  <div class="card-header mt-2">
    <h2>Data User</h2>
  </div>
  <!-- /.card-header -->
  <div class="card-body mb-5">
    <a href="/user_page/create" type="button" class="btn btn-primary mb-1"><i class="fas fa-plus text-white"></i> 
        <i class="fas fa-medkit text-white"></i>  Tambah User</a>
    <table id="example1" class="table table-bordered table-striped">
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
            <a href="/user_page/show/{{ $user->id }}" class="badge bg-info"><i class="bi bi-eye-fill"> Lihat</i></a>
            @can('superadmin')
            <a href="/user_page/edit/{{ $user->id }}" class="badge bg-warning"><i class="bi bi-pencil-square"> Edit</i></a>
            @endcan
            <a href="/user_page/delete/{{ $user->id }}" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"> Hapus</i></a>
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
  <!-- /.card-body -->
</div>
@push('datatable-scripts')
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
  @endpush

@endsection