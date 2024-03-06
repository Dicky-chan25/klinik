<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Supplier</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.supplier.component.modal_delete')
            @include('dashboard.supplier.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('supplier-create') }}" class="text-light">
                    <div class="btn btn-primary">
                        Create
                    </div>
                </a>
                <div class=""></div>
                <div class="d-flex">
                    <!-- Button Filter -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterUser">
                        Filter
                    </button>
                    @include('dashboard.supplier.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        {{-- <th>Jenis</th> --}}
                        <th>Nama Petugas</th>
                        <th>Kontak Petugas</th>
                        <th>Di buat tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $spr)
                    <tr>
                        <td>{{ $spr->name }}</td>
                        <td style="max-width: 200px">{{ $spr->address }}</td>
                        <td>{{ $spr->officer }}</td>
                        <td>{{ $spr->contact }}</td>
                        <td>{{ date('d-m-Y', strtotime($spr->createdAt)) }}</td>
                        <td>
                            @if ($access->edit == 1)
                            <a href="{{route('supplier-edit', ['id' => $spr->id])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                            @if ($access->delete == 1)
                            <!-- Button Delete -->
                            <a class="btn btn-danger data-delete" href="#" data-target="#deleteData" data-toggle="modal"
                                data-delsprid="{{$spr->id}}" data-deltitle="{{$spr->name}}">
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