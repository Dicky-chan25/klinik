<title>Jadwal Praktek</title>
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
        <div class="card-header mt-3">
        <h2>Semua Jadwal Praktek</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body mb-5">
            <a href="/jadwal/create" class="btn btn-primary mb-1">
            <i class="fas fa-plus text-white"></i> <i class="fas fa-database text-white"></i>  Tambah Jadwal Praktek</a>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jadwal</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $jp)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $jp->jadwalpraktek }} </td>
                            <td class="text-sm">
                                <a href="/jadwal/edit/{{ $jp->id }}" class="btn btn-warning" data-bs-toggle="tooltip"
                                    data-bs-original-title="Edit Pasien">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="/jadwal/delete/{{ $jp->id }}" class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
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
