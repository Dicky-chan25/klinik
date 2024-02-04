<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Stock Detail</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.settings.menus.component.modal_delete')

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>status</th>
                        <th>masuk tanggal</th>
                        <th>keluar tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailStock as $ds)
                        <tr>
                            <td>{{ $ds->barcode }}</td>
                            <td>
                                @if ($ds->status == 1)
                                    <span class="badge badge-secondary p-2">Item Keluar</span>
                                @elseif($ds->status == 0)
                                    <span class="badge badge-info p-2">Item Masuk</span>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($ds->createdAt))  }}</td>
                            <td>{{ $ds->status == 0 ? 'Belum Keluar' : date('d-m-Y', strtotime($ds->updatedAt))  }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
