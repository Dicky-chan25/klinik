<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Resep Obat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Resep</th>
                        <th>Nama Obat</th>
                        <th>Jenis</th>
                        <th>Umur</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Dibuat Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($allPrescription as $ap)
                        <tr>
                            <td>{{ $ap->resepCode }}</td>
                            <td>{{ $ap->nameMedicine }}</td>
                            <td>{{ $ap->category }}</td>
                            <td>{{ $ap->ageName }}</td>
                            <td>{{ $ap->qty }}</td>
                            <td>{{ Str::limit($ap->info, 20) }}</td>
                            <td>{{ date('d-m-Y', strtotime($ap->createdAt)) }}</td>
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
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>