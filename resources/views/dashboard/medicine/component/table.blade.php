<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Obat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.medicine.component.modal_delete')
            @include('dashboard.medicine.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                @if ($access->create == 1)
                <a href="{{route('obat-create')}}" class="text-light">
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
                    @include('dashboard.medicine.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Obat</th>
                        <th>Exp Date</th>
                        <th>Harga(20%)</th>
                        <th>Harga Pokok</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Satuan</th>
                        <th>Kategori</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $dr)
                    <tr>
                        <td>{{ $dr->code }}</td>
                        <td>{{ $dr->medName }}</td>
                        <td>{{ $dr->exp }}</td>
                        <td>{{ $dr->ppu+(20/100*($dr->ppu)) }}</td>
                        <td>{{ $dr->ppu }}</td>
                        <td>{{ $dr->stockout }}</td>
                        <td>
                            @if ($dr->stockout < 20 && $dr->stockout > 0)
                                <span class="badge badge-warning text-dark p-2">Hampir Habis</span>
                            @elseif ($dr->stockout === 0)
                                <span class="badge badge-danger p-2">Stock Habis</span>
                            @else
                                <span class="badge badge-primary p-2">Tersedia</span>
                            @endif
                        </td>
                        <td>{{ $dr->title }}</td>
                        <td>{{ $dr->nameCat }}</td>
                        <td>
                            <a href="#" class="btn btn-icon btn-info">
                                <i class="fas fa-list"></i>
                            </a>
                            {{-- @if ($access->edit == 1)
                                <a class="btn btn-icon btn-warning" href="#" data-target="#editUser" data-toggle="modal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            @if ($access->delete == 1)
                                <!-- Button Delete -->
                                <a class="btn btn-icon btn-danger user-delete" href="#" data-target="#deleteUser" data-toggle="modal"
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


