<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Dokter</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.doctor.component.modal_delete')
            @include('dashboard.doctor.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('dokter-create') }}" class="text-light">
                    <div class="btn btn-primary">
                        Create
                    </div>
                </a>
                <div class="d-flex">
                    <!-- Button Delete -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterUser">
                        Filter
                    </button>
                    @include('dashboard.doctor.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Dokter</th>
                        <th>ID Dokter</th>
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
                        <td>{{ $saItem->doctorname }}</td>
                        <td>{{ $saItem->code }}</td>
                        <td>{{ $saItem->gender == 1 ? 'Pria' : ($saItem->gender == 2 ? 'Wanita' : 'Tidak Ada')  }}</td>
                        <td>{{ $saItem->hp }}</td>
                        <td>{{ $saItem->email }}</td>
                        <td>
                            @if ($saItem->status == 1)
                                <span class="badge badge-primary p-2">Aktif</span>
                            @elseif($saItem->status == 0)
                                <span class="badge badge-secondary p-2">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            {{-- not ready --}}
                            {{-- <a href="{{route('pegawai-detail',['id'=>$saItem->id ])}}" class="btn btn-info">
                                <i class="fas fa-list"></i>
                            </a> --}}
                            {{-- get by role user --}}
                            @if ($access->edit == 1)
                            <a href="{{route('dokter-edit',['id'=>$saItem->id ])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                            @if ($access->delete == 1)
                            <a class="btn btn-danger data-delete" href="#" data-target="#deleteData" data-toggle="modal"
                                data-delid="{{$saItem->id}}" data-delname="{{$saItem->title}}">
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