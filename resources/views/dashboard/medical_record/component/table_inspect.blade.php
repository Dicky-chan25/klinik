
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lihat Pemeriksaan Lanjutan</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-4">
            @if ($dataMr->status < 4)
                <a href="{{ route('rekammedis-create-inspect', ['id' => $dataMr->id]) }}">
                    <div class="btn btn-primary">Buat Pemeriksaan Lanjutan</div>
                </a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Resep</th>
                        <th>Nama Pemeriksaan</th>
                        <th>Biaya</th>
                        <th>Keterangan</th>
                        <th>Dibuat Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allInspect as $ai)
                        <tr>
                            <td>{{ $ai->ispCode }}</td>
                            <td>{{ $ai->ispName }}</td>
                            <td>Rp. {{ number_format($ai->price) }}</td>
                            <td>{{ Str::limit($ai->info, 20) }}</td>
                            <td>{{ date('d-m-Y', strtotime($ai->createdAt)) }}</td>
                            <td>
                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-list"></i>
                                </a>
                                @if ($dataMr->status == 3)
                                    <a href="#" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>