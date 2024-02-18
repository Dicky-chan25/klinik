<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Rekam Medis</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.settings.userlevels.component.modal_delete')
            @include('dashboard.settings.userlevels.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('rekammedis-create') }}" class="text-light">
                    <div class="btn btn-primary">
                        Create
                    </div>
                </a>
                <div class="d-flex">
                    <!-- Button Delete -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterUser">
                        Filter
                    </button>
                    @include('dashboard.patient.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Rekam Medis</th>
                        <th>Nama Pasien</th>
                        <th>Layanan
                        <th>Status</th>
                        <th>Di buat tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $rmItem)
                        <tr>
                            <td>{{ $rmItem->rmCode }}</td>
                            <td>{{ $rmItem->patientName }}</td>
                            <td>{{ $rmItem->serviceName }}</td>
                            <td>
                                {{-- register from landing page --}}
                                @if ($rmItem->status == 0)
                                <span class="badge badge-primary p-2" style="background-color:rgb(111, 111, 111)">Belum Diproses</span>
                                @endif
                                 {{-- register from admin --}}
                                @if ($rmItem->status == 1)
                                    <span class="badge badge-primary p-2" style="background-color:rgb(111, 111, 111)">Belum Diproses</span>
                                @endif
                                @if ($rmItem->status == 2)
                                    <span class="badge badge-primary p-2" style="background-color:purple">Sudah Diproses Admin</span>
                                @endif
                                @if ($rmItem->status == 3)
                                    <span class="badge badge-primary p-2" style="background-color:rgb(22, 6, 162)">Sudah Diproses Perawat</span>
                                @endif    
                                @if ($rmItem->status == 4)
                                    <span class="badge badge-primary p-2" style="background-color:rgb(76, 189, 189)">Sudah Diproses Dokter</span>
                                @endif     
                                @if ($rmItem->status == 5)
                                    <span class="badge badge-primary p-2" style="background-color:rgb(200, 86, 97)">Diproses Kasir</span>
                                @endif     
                                @if ($rmItem->status == 6)
                                    <span class="badge badge-primary p-2" style="background-color:green">Selesai</span>
                                @endif     
                            </td>
                            <td>{{ date('d-m-Y', strtotime($rmItem->createdAt)) }}</td>
                            <td>
                                <a href="{{ route('rekammedis-v2-periksa', ['id' => $rmItem->rmId]) }}" class="btn btn-info">
                                    <i class="fas fa-list"></i>
                                </a>
                               
                                @switch($rmItem->status)
                                    @case(0)
                                    @case(1)
                                        <a href="{{route('rekammedis-edit-admin', ['id' => $rmItem->rmId])}}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @break
                                    @case(2)
                                        <a href="{{route('rekammedis-edit-nurse', ['id' => $rmItem->rmId])}}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @break
                                    @case(3)
                                        <a href="{{route('rekammedis-edit-doctor', ['id' => $rmItem->rmId])}}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @break
                                    @case(4)
                                    @case(5)
                                        <a href="{{route('rekammedis-edit-cashier', ['id' => $rmItem->rmId])}}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @break
                                    @default
                                        <div class=""></div>
                                @endswitch
                                <!-- Button Delete -->
                                {{-- <a class="btn btn-danger userlevel-delete" href="#" data-target="#deleteUser" data-toggle="modal"
                                data-dellevelid="{{$paItem->levelId}}" data-deluserlevel="{{$paItem->levelName}}">
                                <i class="fas fa-trash"></i>
                            </a> --}}
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
