<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Pegawai</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.settings.userlevels.component.modal_delete')
            @include('dashboard.settings.userlevels.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('pegawai-create') }}" class="text-light">
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
                        <th>Nama Pegawai</th>
                        <th>ID Pegawai</th>
                        <th>Tempat/Tgl Lahir</th>
                        <th>Posisi</th>
                        <th>Gender</th>
                        <th>No. Telp</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $saItem)
                    <tr>
                        <td>{{ $saItem->name }}</td>
                        <td>{{ $saItem->staffCode }}</td>
                        <td>{{ date('d-m-Y', strtotime($saItem->birthDate)) }}</td>
                        <td>{{ $saItem->role }}</td>
                        <td>{{ $saItem->gender == 1 ? 'Pria' : ($saItem->gender == 2 ? 'Wanita' : 'Tidak Ada')  }}</td>
                        <td>{{ $saItem->phone }}</td>
                        <td>{{ $saItem->email }}</td>
                        <td>
                            @if ($saItem->status == 1)
                                <span class="badge badge-primary p-2">Aktif</span>
                            @elseif($saItem->status == 0)
                                <span class="badge badge-secondary p-2">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($saItem->createdAt)) }}</td>
                        <td>
                            {{-- not ready --}}
                            {{-- <a href="{{route('pegawai-detail',['id'=>$saItem->id ])}}" class="btn btn-info">
                                <i class="fas fa-list"></i>
                            </a> --}}
                            {{-- get by role user --}}
                            {{-- <a href="{{route('pegawai-edit',['id'=>$saItem->id ])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger userlevel-delete" href="#" data-target="#deleteUser" data-toggle="modal"
                                data-dellevelid="{{$saItem->levelId}}" data-deluserlevel="{{$saItem->levelName}}">
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