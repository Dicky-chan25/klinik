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

            <div class="col-md-8">
                <h2>Pilihan Jenis Obat</h2>
                <a href="/jenis_obat/create" class="btn btn-primary mb-1">
                    <i class="fas fa-plus text-white"></i> <i class="fas fa-database text-white"></i>  Tambah Jenis Obat</a>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-flush" id="products-list">
                            <thead class="table table-bordered thead-dark">
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
                                            <a href="/jenis_obat/edit/{{ $p->id }}" class="badge bg-warning" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit Pasien">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
            
                                            <a href="/jenis_obat/delete/{{ $p->id }}" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $jenis->links() }}
            </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#products-list').DataTable({
                        
                        lengthMenu: [
                            [10, 25, 100, -1],
                            ['10', '25', '100', 'All']
                        ],
                        language: {
                            "searchPlaceholder": "Cari Jenis obat",
                            "zeroRecords": "Tidak ditemukan Jenis Obat yang sesuai",
                            "emptyTable": "Tidak terdapat data di tabel"
                        }
                    });
                });
            </script>
        @endpush
@endsection