<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Kunjungan</h6>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="container" for="">Cari Nama, Nomor Rekam Medis, NIK, Nomor HP</label>
            <div class="d-flex">
                <form action="{{route('pendaftaran')}}" class="d-flex">
                    @csrf
                    <div class="col-lg-6">
                        <input id="search" name="search" type="text" class="form-control">
                    </div>
                    <div class="col-lg-6 d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Cari</button>
                        <a style="width: 340px" href="{{route('pasien-create')}}" class="btn btn-info mr-2">Tambah Pasien Baru</a>
                        <a style="width: 340px" href="{{route('pasien')}}" class="btn btn-success">Lihat Semua Pasien</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="table table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor Rekam Medis</th>
                            <th>Jenis Kelamin</th>
                            <th>NIK</th>
                            <th>No. HP</th>
                            <th>Opsi</th>
                            <th>Riwayat Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($searchResult as $sr)
                            
                            <tr>
                                <td>{{$sr->name}}</td>
                                <td>{{$sr->code}}</td>
                                <td>{{$sr->gender === '1' ? 'Pria' : 'Wanita'}}</td>
                                <td>{{$sr->identity}}</td>
                                <td>{{$sr->phone}}</td>
                                <td class="table-action">
                                    <a href="{{route('pendaftaran-create', ['patientId' => $sr->id])}}" class="btn btn-sm btn-primary">Proses Daftar</a>
                                </td>
                                <td class="table-action">
                                    <a href="" class="btn btn-sm btn-info">Riwayat Kunjungan</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>