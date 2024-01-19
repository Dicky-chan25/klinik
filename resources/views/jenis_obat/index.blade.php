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

        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header mt-3">
              <h2>Daftar Jenis Obat</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body mb-5">
                <a href="/jenis_obat/create" class="btn btn-primary mb-1">
                  <i class="fas fa-plus text-white"></i> <i class="fas fa-database text-white"></i>  Tambah Jenis Obat</a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th>Tools</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($jenis as $index => $p)
                      <tr>
                          <td>{{ $jenis->firstItem() + $index }}</td>
                          <td> {{ $p->jenisobat }}</td>

                          <td class="text-sm">
                              <a href="/jenis_obat/edit/{{ $p->id }}" class="btn btn-warning" data-bs-toggle="tooltip"
                                  data-bs-original-title="Edit Pasien">
                                  <i class="bi bi-pencil-square"></i>
                              </a>

                              <a href="/jenis_obat/delete/{{ $p->id }}" class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>

                          </td>
                      </tr>
                  @endforeach
              </tbody>
  
              </table>
            </div>
            <!-- /.card-body -->
            {{-- {{ $jenis->links() }} --}}
          </div>
          @endsection
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
