<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.settings.userlevels.component.modal_delete')
            @include('dashboard.settings.userlevels.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('userlevels-create') }}" class="text-light">
                    <div class="btn btn-primary">
                        Create
                    </div>
                </a>
                <div class="d-flex">
                    <!-- Button Delete -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterUser">
                        Filter
                    </button>
                    @include('dashboard.settings.userlevels.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Level</th>
                        <th>status</th>
                        <th>di buat tanggal</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $item)
                    <tr>
                        <td>{{ $item->levelName }}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge badge-primary p-2">Aktif</span>
                            @elseif($item->status == 0)
                                <span class="badge badge-secondary p-2">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $item->createdAt }}</td>
                        <td>
                            <a href="{{route('userlevels-detail',['id'=>$item->levelId ])}}" class="btn btn-info">
                                <i class="fas fa-list"></i>
                            </a>
                            <a href="{{route('userlevels-edit',['id'=>$item->levelId ])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Button Delete -->
                            <a class="btn btn-danger userlevel-delete" href="#" data-target="#deleteUser" data-toggle="modal"
                                data-dellevelid="{{$item->levelId}}" data-deluserlevel="{{$item->levelName}}">
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