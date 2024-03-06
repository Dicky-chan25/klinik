<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Pasien</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.transaction.component.modal_delete')
            @include('dashboard.transaction.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                {{-- <a href="{{ route('pasien-create') }}" class="text-light">
                    <div class="btn btn-primary">
                        Create
                    </div>
                </a> --}}
                <div class=""></div>
                <div class="d-flex">
                    <!-- Button Delete -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterUser">
                        Filter
                    </button>
                    @include('dashboard.transaction.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Pasien</th>
                        <th>Total Bayar(Rp.)</th>
                        <th>Total Uang(Rp.)</th>
                        <th>Kembalian(Rp.)</th>
                        <th>Status</th>
                        <th>Di buat tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $trx)
                    <tr>
                        <td>{{ $trx->code }}</td>
                        <td>{{ $trx->patient }}</td>
                        <td>{{ number_format($trx->bill) }}</td>
                        <td>{{ number_format($trx->pay) }}</td>
                        <td>{{ number_format($trx->return) }}</td>
                        <td>
                            @if ($trx->status == 1)
                                <span class="badge badge-primary p-2">Aktif</span>
                            @elseif($trx->status == 0)
                                <span class="badge badge-secondary p-2">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($trx->createdAt)) }}</td>
                        <td>
                            <!-- Button Delete -->
                            <a class="btn btn-danger data-delete" href="#" data-target="#deleteData" data-toggle="modal"
                                data-deltrxid="{{$trx->id}}" data-deltitle="{{$trx->code}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="max-width: 100%; overflow-x:auto; display:flex; justify-content:space-between">
                <p class="text-bold">Showing {{ $dataResult->firstItem() }} to {{ $dataResult->lastItem() }} of
                    {{ $dataResult->total() }}</p>
                    {{ $dataResult->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>