<title>Pasien Sebelum di Diagnosa</title>
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
            <h3>Data Diagnosa Pasien Harian</h3>
            </div> 
            <div class="card-body mb-5">
        
            <table class="table table-bordered" id="products-list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Diagnosa</th>
                        <th>Nomer Antrian</th>
                        <th>Kode Pasien</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur</th>
                        <th>Jenis Layanan</th>
                        <th>Keluhan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 0;
                    @endphp
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $count=$count+1 }}</td>
                        <td> 
                            <a href="diagnosatools/edit{{ $row->id }}" data-bs-toggle="tooltip" data-bs-original-title="Tambah Diagnosa Pasien" class="btn btn-success">
                                <i class="fas fa-stethoscope text-white"></i>
                            </a>
                        </td>
                        <td>{{ $row->nomorantrian }}</td>
                        <td>{{ $row->pasien == '' ? 'Belum ada kode' : $row->pasien->kodepasien }}</td>
                        <td>{{ $row->pasien->nama }}</td>
                        <td>{{ $row->pasien->lahir->format('d/M/Y'); }}</td>
                        <td>{{ $row->pasien->lahir->age }} Tahun</td>
                        <td>{{ $row->layanan }}</td>
                        <td>{{ $row->keluhan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#products-list').DataTable({
                    dom: 'lBfrtip',
                    lengthMenu: [
                        [50, 100, 1000, -1],
                        ['50', '100', '1000', 'All']
                    ],
                    buttons: [{
                            extend: 'excel',
                            text: 'Excel',
                            messageTop: 'Data Antrian Harian per Tanggal '+'{{  \Carbon\Carbon::now()->format("d-M(m)-Y") }}'
                            
                        },
                        {
                            extend: 'copy',
                            text: 'Copy Isi',
                            messageTop: 'Data Antrian Harian per Tanggal '+'{{  \Carbon\Carbon::now()->format("d-M(m)-Y") }}'
                            
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
@endsection
