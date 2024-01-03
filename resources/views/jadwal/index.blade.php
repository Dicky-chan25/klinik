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
    <div class="container">
        <h1>Semua Jadwal Praktek</h1>
        <br>

        </-------------------------------------------------------- Tabel
            -----------------------------------------------------------------------------------* />
        <a href="/jadwal/create" type="button" class="btn btn-success">
            <i class="fas fa-plus text-white"></i> <i class="fas fa-calendar text-white"></i>  Tambah Jadwal Praktek</a>

        <div class="table-responsive">
            <table class="table table-flush" id="products-list">
                <thead class="thead-dark">
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
                                <a href="jadwal/edit/{{ $jp->id }}" class="badge bg-warning" data-bs-toggle="tooltip"
                                    data-bs-original-title="Edit Pasien">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="/jadwal/delete/{{ $jp->id }}" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>



    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#products-list').DataTable({
                    lengthMenu: [
                        [10, 100, -1],
                        ['10', '100', 'All']
                    ],
                    
                    language: {
                        "searchPlaceholder": "Cari jadwal",
                        "zeroRecords": "Tidak ditemukan jadwal",
                        "emptyTable": "Tidak terdapat jadwal di tabel"
                    }
                });
            });
        </script>
    @endpush
@endsection
