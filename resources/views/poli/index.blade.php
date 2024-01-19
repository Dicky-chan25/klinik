<title>Daftar Poli</title>
@extends('layout.main')
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
        <div class="card-header mt-2">
          <h2>Daftar Poli</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body mb-5">
            <a href="/poli/create" type="button" class="btn btn-primary mb-1"><i class="fas fa-plus text-white"></i> 
                <i class="fas fa-medkit text-white"></i>  Tambah Poli</a>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Poli</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($poli as $p)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $p->name }} </td>
                        <td class="text-sm">
                            <a href="/poli/edit/{{ $p->id }}" class="badge bg-warning" data-bs-toggle="tooltip"
                                data-bs-original-title="Edit Pasien">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a href="/poli/delete/{{ $p->id }}" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>

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