@extends('layout.main')
<title>Dashboard Obat</title>
@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Total Stok Obat</h1>
    </div>


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

      
    <div class="col-md">
        <div class="card">
          <div class="card-header">
            <a href="/obat_page/obat_form" type="button" class="btn btn-success"><i class="fas fa-plus text-white"></i> 
                <i class="fas fa-medkit text-white"></i>  Tambah Obat</a>
          </div>
          <!-- /.card-header -->
          <div class="table-responsive">
            <table class="table table-flush" id="products-list">
                <thead class="thead-dark">
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
                    <th>Tanggal Buat</th>
                    <th>Tanggal Expired</th>
                    <th>Photo</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($obat as $p)
                <tr>
                    <td> 1 </td>
                    </-------------------------------------------------------- edit
                        -----------------------------------------------------------------------------------* />
                    <td>
                        <a href="/obat_page/edit/{{ $p->id }}" class="badge bg-warning" data-bs-toggle="tooltip">
                            <i class="fas fa-pen text-white"></i>
                        </a>

                        <a href="{{-- edit stok --}}" class="badge bg-warning" data-bs-toggle="tooltip">
                            <i class="fas fa-cube text-white"></i>
                        </a>

                        </-------------------------------------------------------- hapus
                            -----------------------------------------------------------------------------------* />
                        <a href="/obat_page/delete/{{ $p->id }}" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
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
                    <td><img src="{{ asset('storage/' . $p->image) }}" alt="" width="100%"></td>
                </tr>
                    
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
          </div>
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      {{-- @push('scripts')
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
                          messageTop: 'Data Obat dicetak per Tanggal '+'{{  \Carbon\Carbon::now()->format("d-M(m)-Y") }}'
                          
                      },
                      {
                          extend: 'copy',
                          text: 'Copy Isi',
                          messageTop: 'Data Obat dicetak per Tanggal '+'{{  \Carbon\Carbon::now()->format("d-M(m)-Y") }}'
                          
                      },
                  ],
                  language: {
                      "searchPlaceholder": "Cari nama obat",
                      "zeroRecords": "Tidak ditemukan data yang sesuai",
                      "emptyTable": "Tidak terdapat data di tabel"
                  }
              });
          });
      </script>
        @endpush --}}
@endsection