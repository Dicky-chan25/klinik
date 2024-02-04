<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Stock Obat Keluar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.medicine.in.component.modal_delete')
            @include('dashboard.medicine.in.component.modal_filter')
            {{-- @include('dashboard.medicine.in.component.modal_edit') --}}

            <div class="d-flex justify-content-between my-2">
                <div class=""></div>
                <div class="d-flex">
                    <!-- Button Delete -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterUser">
                        Filter
                    </button>
                    @include('dashboard.settings.menus.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Barcode</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Tanggal Keluar Barang</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $item)
                        <tr>
                            <td>{{ $item->medsName }}</td>
                            <td>{{ $item->barcode }}</td>
                            <td>{{ $item->supplier }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge badge-secondary p-2">Item Keluar</span>
                                @elseif($item->status == 0)
                                    <span class="badge badge-info p-2">Item Masuk</span>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($item->updatedAt)) }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">
                                    <div class="text-dark">Reset Item</div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="max-width: 700px; overflow-x:auto;">
                {{ $dataResult->withQueryString()->links() }}
                <p class="text-bold">Showing {{ $dataResult->firstItem() }} to {{ $dataResult->lastItem() }} of
                    {{ $dataResult->total() }}</p>
            </div>
        </div>
    </div>
</div>
