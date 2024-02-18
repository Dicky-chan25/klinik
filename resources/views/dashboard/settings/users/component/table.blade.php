<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.settings.users.component.modal_delete')
            @include('dashboard.settings.users.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                @if ($access->create == 1)
                <a href="{{ route('users-create') }}" class="text-light">
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
                    @include('dashboard.settings.users.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>username</th>
                        <th>email</th>
                        <th>Level User</th>
                        <th>di buat tanggal</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $item)
                    <tr>
                        <td>{{ $item->fName.' '.$item->lName }}</td>
                        <td>{{ $item->uName }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->levelName }}</td>
                        <td>{{ $item->createdAt }}</td>
                        <td>
                            @if ($access->edit == 1)
                            <a href="{{route('users-edit',['id'=>$item->userId ])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                            @if ($access->delete == 1)
                                <!-- Button Delete -->
                                <a class="btn btn-danger user-delete" href="#" data-target="#deleteUser" data-toggle="modal"
                                    data-deluserid="{{$item->userId}}" data-delusername="{{$item->uName}}">
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