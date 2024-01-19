<title>Dokter</title>
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
            <h2>Data Dokter</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body mb-5">
                <a href="/dokter_page/create" class="btn btn-primary mb-1">
                <i class="fas fa-plus text-white"></i> <i class="fas fa-database text-white"></i>  Tambah Dokter</a>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Spesialis</th>
                            <th>Nomer Telepon</th>
                            <th>Jadwal Praktek</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokter as $index => $d)
                            <tr>
                                <td> {{ $dokter->firstItem() + $index }}</td>
                                <td> {{ $d->nama }} </td>
                                <td> {{ $d->alamat }} </td>
                                <td> {{ $d->poli->name ?? "Poli kosong"}} </td>
                                <td> {{ $d->telepon }} </td>
                                <td> {{ $d->jadwal->jadwalpraktek ?? "jadwal kosong"}} </td>

                                </-------------------------------------------------------- edit
                                    -----------------------------------------------------------------------------------* />
                                <td class="text-sm">
                                    <a href="/dokter_page/edit/{{ $d->id }}" class="btn btn-warning" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit Dokter">
                                        <i class="fas fa-pen text-white"></i>
                                    </a>

                                    </-------------------------------------------------------- hapus
                                        -----------------------------------------------------------------------------------* />
                                        <a href="/dokter_page/delete/{{ $d->id }}" class="btn btn-danger border-0" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i></a>
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