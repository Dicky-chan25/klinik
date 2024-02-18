<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Obat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.medicine.all.component.modal_delete')
            @include('dashboard.medicine.all.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                @if ($access->create == 1)
                <a href="{{ route('semuaobat-create') }}" class="text-light">
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
                    @include('dashboard.medicine.all.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Nama Supplier</th>
                        <th>Kontak Supplier</th>
                        <th>Status</th>
                        <th>Di Tambahkan Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->medName }}</td>
                        <td>{{ $item->sName }}</td>
                        <td>{{ $item->sContact }}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge badge-primary p-2">Aktif</span>
                            @elseif($item->status == 0)
                                <span class="badge badge-secondary p-2">Aktif</span>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($item->createdAt)) }}</td>
                        <td>
                            <a href="{{route('semuaobat-detail',['id' => $item->medId])}}" class="btn btn-info">
                                <i class="fas fa-list"></i>
                            </a>
                            @if ($access->edit == 1)
                                <a class="btn btn-warning" href="#" data-target="#editUser" data-toggle="modal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif

                            @include('dashboard.medicine.all.component.modal_edit')
                            {{-- @if ($access->delete == 1)
                                <!-- Button Delete -->
                                <a class="btn btn-danger user-delete" href="#" data-target="#deleteUser" data-toggle="modal"
                                    data-deluserid="12" data-delusername="12">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endif --}}
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


