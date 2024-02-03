<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.settings.menus.component.modal_delete')

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>route</th>
                        <th>status</th>
                        <th>di buat tanggal</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataDetail as $di)
                        <tr>
                            <td>{{ $di->menuName }}</td>
                            <td>{{ $di->routePath }}</td>
                            <td>
                                @if ($di->status == 1)
                                    <span class="badge badge-primary p-2">Aktif</span>
                                @elseif($di->status == 0)
                                    <span class="badge badge-secondary p-2">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $di->createdAt }}</td>
                            <td>
                                <!-- Button Detail -->
                                @if ($di->isParent == 1)
                                    <a href="{{ route('menu-detail', ['id' => $di->menuId]) }}" class="btn btn-info">
                                        <i class="fas fa-list"></i>
                                    </a>
                                @elseif($di->isParent == 0)
                                    <div class="btn btn-secondary"><i class="fas fa-list"></i></div>
                                @endif
                                <!-- Button Edit -->
                                <a href="{{ route('menu-edit', ['id' => $di->menuId]) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Button Delete -->
                                <a class="btn btn-danger menu-delete" href="#" data-target="#deleteUser"
                                    data-toggle="modal" data-delmenuid="{{ $di->menuId }}"
                                    data-delmenu="{{ $di->menuName }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
