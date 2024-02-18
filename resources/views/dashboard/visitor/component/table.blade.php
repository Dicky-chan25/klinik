<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Kunjungan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex justify-content-between my-2">
                <a href="{{ route('antrian-create') }}" class="text-light">
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
                        <th>No Registrasi</th>
                        <th>No Kunjungan</th>
                        <th>Poli</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Di buat tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $paItem)
                    <tr>
                        <td>{{ $paItem->patientName }}</td>
                        <td>{{ $paItem->regNo }}</td>
                        <td>{{ $paItem->queueNo }}</td>
                        <td>{{ $paItem->poliName }}</td>
                        <td>{{ $paItem->serviceName }}</td>
                        <td>
                            @if ($paItem->status == 0)
                            <div class="btn btn-primary">Menunggu</div>
                            @elseif($paItem->status == 1)
                            <div class="btn btn-primary">Proses</div>
                            @elseif($paItem->status == 2)
                            <div class="btn btn-primary">Selesai</div>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($paItem->createdAt)) }}</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fas fa-list"></i>
                            </a>
                            <a href="#" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Button Delete -->
                            {{-- <a class="btn btn-danger userlevel-delete" href="#" data-target="#deleteUser"
                                data-toggle="modal" data-dellevelid="{{$paItem->levelId}}"
                                data-deluserlevel="{{$paItem->levelName}}">
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