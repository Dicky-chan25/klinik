<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Stock Obat Masuk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.medicine.in.component.modal_delete')
            @include('dashboard.medicine.in.component.modal_filter')
            {{-- @include('dashboard.medicine.in.component.modal_edit') --}}

            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('obatmasuk-create') }}" class="text-light">
                    <div class="btn btn-primary">
                        Create
                    </div>
                </a>
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
                        <th>Supplier Obat</th>
                        <th>Qty</th>
                        <th>di buat tanggal</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $item)
                        <tr>
                            <td>{{ $item->medsName }}</td>
                            <td>{{ $item->supplier }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->createdAt)) }}</td>
                            <td>
                                <a href="{{route('obatmasuk-detail',['id' => $item->medsId])}}" class="btn btn-info">
                                    <i class="fas fa-list"></i>
                                </a>
                                {{-- @if ($access->edit == 1)
                                    <!-- Button Edit | fitur ini aktif jika di cek dlu stocknya ada yg keluar atau blm , apabila blm, full edit-->
                                    <a class="btn btn-warning user-delete" href="#" data-target="#deleteUser" data-toggle="modal"
                                        data-editid="{{$item->medsId}}" 
                                        data-editname="{{$item->medsName}}"
                                        data-editsupplier="{{$item->supplier}}"
                                        data-editqty="{{$item->qty}}"
                                        >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif --}}
                                @if ($access->delete == 1)
                                    <!-- Button Delete | fitur ini aktif jika di cek dlu stocknya ada yg keluar atau blm -->
                                    <a class="btn btn-danger data-delete" href="#" data-target="#deleteData" data-toggle="modal"
                                    data-dellevelid="{{$item->medsId}}" data-deluserlevel="{{$item->medsName}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
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
