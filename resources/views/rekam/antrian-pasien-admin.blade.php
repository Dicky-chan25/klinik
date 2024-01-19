<title>Antrian-Pasien (Jam {{  \Carbon\Carbon::now()->format("H:i") }})</title>
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
        <h2 class="mt-3 ml-3">Data Antrian Pasien Harian</h2>

        </-------------------------------------------------------- Tabel
            -----------------------------------------------------------------------------------* />
        <br />
        <div class="card-body mb-5">
        <div class="table-responsive">
            <table class="table table-flush" id="products-list">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tools</th>
                        <th>No Antrian</th>
                        <th>Jam Daftar</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Jenis Layanan</th>
                        <th>Keluhan</th>
                        <th>Dokter</th>

                        <th>Alamat</th>
                        <th>NIK</th>
                        <th>Nomer Telepon</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>                       
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 0;
                    @endphp
                    @foreach($datarekam as $row)
                        <tr>
                            <td>{{ $count = $count + 1 }}</td>
                            <td>
                                <a href="/rekam/antrian-pasien-edit-form/edit/{{  $row->id }}" class="badge bg-warning" data-bs-toggle="tooltip">
                                    <i class="fas fa-pen text-white"></i>
                                </a>
                                <a href="/antrian/delete/{{  $row->id }}" class="badge bg-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i></a>
        
                            </td>

                            <td>{{ $row->nomorantrian }}</td>
                            <td>{{ $row->updated_at->format('H:i:s -- d/m/Y'); }}</td>   
                            <td>{{ $row->pasien->nama }}</td>
                            <td>{{ $row->pasien->lahir->format('d/M/Y'); }}</td>
                            <td>{{ $row->pasien->kelamin }}</td>
                            <td>{{ $row->layanan }}</td>
                            <td>{{ $row->keluhan }}</td>
                            <td>{{ $row->dokter->nama ?? "Dokter Tidak ada"}}</td>
                            <td>{{ $row->pasien->alamat }}</td>
                            <td>{{ $row->pasien->nik }}</td>
                            <td>
                                <a href="https://api.whatsapp.com/send?phone=<?php echo $row->pasien['telepon']; ?>"
                                    target=" _blank" title="Pesan WhatsApp" class="btn btn-success">
                                       <b>{{ $row->pasien->telepon }}</b>
                                   </a>
                                
                               </td>
                            <td>{{ $row->pasien->agama }}</td>
                            <td>{{ $row->pasien->pendidikan }}</td>
                            <td>{{ $row->pasien->pekerjaan }}</td>
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
                    dom: 'lBfrtip',
                    lengthMenu: [
                        [50, 100, 5, -1],
                        ['50', '100', '5', 'All']
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

            // <!--------------------------------------------------------auto refresh page----------------------------------------------------------------------------------->
            setTimeout(function() {
                window.location.reload();
            }, 16000);
        </script>
    @endpush
@endsection
