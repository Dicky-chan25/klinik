@include('dashboard.registration.component.modal_confirm')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Data Rawat Pasien Hari Ini</h6>
    </div>
    <div class="card-body">
        <a href="{{route('pendaftaranpasien')}}" class="btn btn-primary float-right mb-4">Pendaftaran Pasien</a>
        <div class="table table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>No. Registrasi</th>
                        <th>No. Rekam Medis</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Periksa</th>
                        <th>Status Rawat</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResultToday as $ddt)
                        <tr>
                            <td class="table-action">
                                <p style="font-size: 24px;color:red;font-weight:bold">{{ $ddt->queueNo }}</p>
                            </td>
                            <td>{{ $ddt->regNo }}</td>
                            <td>{{ $ddt->rmCode }}</td>
                            <td>{{ $ddt->name }}{{ $ddt->gender === 1 ? ', Tn' : ', Ny' }}</td>
                            {{-- <td>{{date('d-m-Y',strtotime($ddt->createdAt))}}</td> --}}
                            <td>{{ $ddt->createdAt }}</td>
                            <td>
                                @if ($ddt->nursingStatus === 1)
                                    <div class="btn btn-primary btn-sm">
                                        <i class="fa fa-stethoscope"></i>
                                        <span class="ml-2">Belum Diperiksa</span>
                                    </div>
                                @else
                                    <div class="btn btn-success btn-sm">
                                        <i class="fa fa-check-circle"></i>
                                        <span class="ml-2">Sudah Diperiksa</span>
                                    </div>
                                @endif
                            </td>
                            <td class="table-action">
                                <a href="{{route('rawatpasien-assesment', ['id' => $ddt->id])}}" class="btn btn-sm btn-info">
                                    <i class="fa fa-plus-square"></i>
                                    <span class="ml-2">Periksa</span>
                                </a>
                                @if ($ddt->isCall === 0)
                                    <a href="#" class="btn btn-sm btn-primary play-audio"
                                        data-callid="{{ $ddt->id }}">
                                        <i class="fa fa-volume-up"></i>
                                        <span class="ml-2">Panggil</span>
                                    </a>
                                @else
                                    <div class="btn btn-sm btn-secondary">
                                        <i class="fa fa-check-circle"></i>
                                        <span class="ml-2">Sudah Panggil</span>
                                    </div>
                                @endif
                                <a href="" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                    <span class="ml-2">Hapus</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
