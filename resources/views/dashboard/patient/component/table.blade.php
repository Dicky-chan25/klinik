<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Pasien</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.settings.userlevels.component.modal_delete')
            @include('dashboard.settings.userlevels.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('pasien-create') }}" class="text-light">
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
                        <th>Nama Pasien</th>
                        <th>Umur(thn)</th>
                        <th>NIK</th>
                        <th>BPJS</th>
                        <th>Nomor Telp / WA</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Di buat tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $paItem)
                    <tr>
                        <td>{{ $paItem->patientName }}</td>
                        <td>{{ Carbon\Carbon::parse($paItem->birthDate)->age }}</td>
                        <td>{{ $paItem->identity }}</td>
                        <td>{{ $paItem->bpjs == '' ? 'Tidak Ada' : $paItem->bpjs }}</td>
                        <td>{{ $paItem->phone }}</td>
                        <td>{{ $paItem->gender == 1 ? 'Pria' : ($paItem->gender == 2 ? 'Wanita' : 'Tidak Ada')  }}</td>
                        <td>
                            @if ($paItem->status == 1)
                                <span class="badge badge-primary p-2">Aktif</span>
                            @elseif($paItem->status == 0)
                                <span class="badge badge-secondary p-2">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($paItem->createdAt)) }}</td>
                        <td>
                            <a href="{{route('pasien-detail',['id'=>$paItem->patientId ])}}" class="btn btn-info">
                                <i class="fas fa-list"></i>
                            </a>
                            <a href="{{route('pasien-edit',['id'=>$paItem->patientId ])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
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