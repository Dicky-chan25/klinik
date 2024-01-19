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
    <div class="card">
        <div class="card-header mt-2">
          <h2>Database Pasien</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body mb-5">
        <div class="table-responsive">
            <table id="example1" class="table table-flush" id="products-list">
                <thead>
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
    {{ $datapasien->links() }}
 
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
          @push('datatable-scripts')
          <script>
              $(function () {
                $("#example1").DataTable({
                  "lengthChange": false, "autoWidth": false,
                  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              });
            </script>
            @endpush
    @endpush
