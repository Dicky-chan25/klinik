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
      <div class="alert alert-success col-lg-10" role="alert">
        {{ session('success') }}
      </div> 
      @endif

      <div class="card">
        <div class="card-header mt-2">
          <h2>Daftar Obat</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body mb-5">
            <a href="/obat_page/obat_form" type="button" class="btn btn-primary mb-1"><i class="fas fa-plus text-white"></i> 
                <i class="fas fa-medkit text-white"></i>  Tambah Obat</a>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Tools</th>
                <th>Kode Obat</th>
                <th>Stok</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Dosis</th>
                <th>Harga</th>
                <th>Tanggal Upload</th>
                <th>Tanggal Expired</th>
                {{-- <th>Photo</th> --}}
            </tr> 
            </thead>
            <tbody>
                @foreach ($obat as $index => $p)
                <tr>
                    <td>{{ $obat->firstItem() + $index }}</td>
                    </-------------------------------------------------------- edit
                        -----------------------------------------------------------------------------------* />
                    <td>
                        <a href="/obat_page/edit/{{ $p->id }}" class="badge bg-warning" data-bs-toggle="tooltip">
                            <i class="fas fa-pen text-white"></i>
                        </a>
                        {{-- <a href="#" class="btn btn-warning" data-bs-toggle="tooltip">
                            <i class="fas fa-cube text-white"></i>
                        </a> --}}
                        </-------------------------------------------------------- hapus
                            -----------------------------------------------------------------------------------* />
                        <a href="/obat_page/delete/{{ $p->id }}" class="badge bg-danger" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i></a>

                    </td>
                    <td> {{ $p->kodeobat =='' ? 'Kode Belum data' : $p->kodeobat }}</td>
                    <td> {{ $p->stok =='' ? 'Stok Kosong' : $p->stok }}</td>
                    <td> {{ $p->namaobat }}</td>
                    <td>{{ $p->jenis=='' ? 'Jenis Belum ada' :  $p->jenis->jenisobat }}</td>
                    <td>
                        @php
                            $expired = date('Y/m/d', strtotime($p->expired));
                            $today = date('Y/m/d');
                        
                            if ($today < $expired) {
                                echo "<font color=green>Bagus</font>";
                            } else {
                                echo "<font color=red>Expired</font>";
                            }
                        @endphp
                    </td>
                    <td> {{ $p->dosis=='' ? 'Dosis Belum ada' : $p->dosis }}</td>
                    <td> {{ "Rp " . number_format($p->harga,2,',','.'); }}</td>
                    <td> {{ $p->created_at->format('d/m/Y   H:i:s'); }}</td>
                    <td> {{ date("d/m/Y", strtotime($p->expired=='' ? 'Expired belum di Set' : $p->expired)); }}</td>
                    {{-- <td><img src="{{ asset('storage/' . $p->image) }}" alt="" width="100%"></td> --}}
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