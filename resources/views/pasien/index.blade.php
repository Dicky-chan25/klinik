<title>Database Pasien </title>
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
        <h1>Database Pasien</h1>
        <br>

        </-------------------------------------------------------- Tabel
            -----------------------------------------------------------------------------------* />
        {{-- <a href="/pasien/tambahpasienform" type="button" class="btn btn-success">
            <i class="fas fa-plus text-white"></i> <i class="fas fa-address-book text-white"></i>  Tambah Pasien</a>
        <br /> --}}
        <div class="table-responsive">
            <table class="table table-flush" id="products-list">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Pasien</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomer Telepon</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datapasien as $p)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td> {{ $p->kodepasien }} </td>
                            <td> {{ $p->nama }} </td>
                            <td> {{ $p->alamat }} </td>
                            <td> {{ $p->lahir->format('Y/M(m)/d') }} </td>
                            <td> {{ $p->nik }} </td>
                            <td> {{ $p->kelamin }} </td>
                            <td> {{ $p->telepon }} </td>
                            <td> {{ $p->agama }} </td>
                            <td> {{ $p->pendidikan }} </td>
                            <td> {{ $p->pekerjaan }} </td>

                            <td class="text-sm">
                                <a href="/pasien/pasien-rekammedis/edit/{{ $p->id }}" class="badge bg-warning" data-bs-toggle="tooltip"
                                    data-bs-original-title="Edit Pasien">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <a href="/pasien/delete/{{ $p->id }}" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#products-list').DataTable({
                    dom: 'lBfrtip',
                    lengthMenu: [
                        [5, 10, 25, 50, 100, 1000, -1],
                        ['5', '10', '25', '50', '100', '1000', 'All']
                    ],
                    buttons: [{
                            extend: 'excel',
                            text: 'Excel',
                            messageTop: 'Data Pasien Dicetak pada Tanggal '+'{{  \Carbon\Carbon::now()->format("d-M(m)-Y") }}'
                        },
                        {
                            extend: 'copy',
                            text: 'Copy Isi',
                            messageTop: 'Data Pasien di Copy pada Tanggal '+'{{  \Carbon\Carbon::now()->format("d-M(m)-Y") }}'                 
                        },
                    ],
                    language: {
                        "searchPlaceholder": "Cari nama pasien",
                        "zeroRecords": "Tidak ditemukan data yang sesuai",
                        "emptyTable": "Tidak terdapat data di tabel"
                    }
                });
            });
        </script>
    @endpush
