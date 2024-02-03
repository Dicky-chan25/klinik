<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Detail Obat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.medicine.all.component.modal_delete')

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Dosis</th>
                        <th>Kategori</th>
                        <th>Rekomendasi Umur</th>
                        <th>Baik Digunakan</th>
                        <th>Keterangan</th>
                        <th>Di Tambahkan Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailMdc as $dMdc)
                    <tr>
                        <td>{{ $dMdc->dose }} x Sehari</td>
                        <td>{{ $dMdc->categoryName }}</td>
                        <td>{{ $dMdc->ageName }}</td>
                        <td>
                            @if ($dMdc->eating == 1)
                                <span class="badge badge-info p-2">Sebelum Makan</span>
                            @elseif($dMdc->eating == 2)
                                <span class="badge badge-warning p-2">Sesudah Makan</span>
                            @endif
                        </td>
                        <td style="max-width: 50px">{{$dMdc->info}}</td>
                        <td>{{ date('d-m-Y', strtotime($dMdc->createdAt)) }}</td>
                        <td>
                            <!-- Button Delete -->
                            <a class="btn btn-danger comp-delete-detail" href="#" data-target="#deleteDataDetail" data-toggle="modal"
                            data-delid="{{$dMdc->id}}" data-deltitle="">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="max-width: 700px; overflow-x:auto;">
                {{ $detailMdc->withQueryString()->links() }}
                <p class="text-bold">Showing {{ $detailMdc->firstItem() }} to {{ $detailMdc->lastItem() }} of
                    {{ $detailMdc->total() }}</p>
            </div>
        </div>
    </div>
</div>