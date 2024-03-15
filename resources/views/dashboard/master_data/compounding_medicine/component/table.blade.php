<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Data Laborat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.master_data.laboratory.component.modal_delete')
            @include('dashboard.master_data.laboratory.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                @if ($access->create == 1)
                    <a href="{{ route('obatracik-create') }}" class="text-light">
                        <div class="btn btn-primary">
                            Create
                        </div>
                    </a>
                @endif
                <div class="d-flex">
                    <!-- Button Delete -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterUser">
                        Filter
                    </button>
                    @include('dashboard.master_data.laboratory.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Tindakan</th>
                        <th>Harga</th>
                        <th>Dibuat Tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $aaItem)
                    <tr>
                        <td>{{ $aaItem->code }}</td>
                        <td>{{ $aaItem->name }}</td>
                        <td>Rp. {{ number_format($aaItem->price) }}</td>
                        <td>{{ date('d-m-Y', strtotime($aaItem->created_at)) }}</td>
                        <td>
                            @if ($aaItem->status == 1)
                                <span class="badge badge-primary p-2">Aktif</span>
                            @elseif($aaItem->status == 0)
                                <span class="badge badge-secondary p-2">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            @if ($access->edit == 1)
                            <a href="{{route('laborat-edit',['id'=>$aaItem->id ])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                            @if ($access->delete == 1)
                            <a class="btn btn-danger data-delete" href="#" data-target="#deleteData" data-toggle="modal"
                                data-delid="{{$aaItem->id}}" data-delname="{{$aaItem->name}}">
                                <i class="fas fa-trash"></i>
                            </a> 
                            @endif
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