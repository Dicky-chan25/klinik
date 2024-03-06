@include('dashboard.registration.component.modal_confirm')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Pendaftaran</h6>
    </div>
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. Reg</th>
                        <th>Nama</th>
                        <th>No. Rekam Medis</th>
                        <th>Jenis Kelamin</th>
                        <th>NIK</th>
                        <th>No. HP</th>
                        <th>Antrian</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResult as $dd)
                    <tr>
                        <td>{{$dd->regNo}}</td>
                        <td>{{$dd->name}}</td>
                        <td>{{$dd->rmCode}}</td>
                        <td>{{$dd->gender === '1' ? 'Pria' : 'Wanita' }}</td>
                        <td>{{$dd->identity}}</td>
                        <td>{{$dd->phone}}</td>
                        <td class="table-action">
                            <p style="font-size: 24px;color:red;font-weight:bold">{{$dd->queueNo}}</p>
                        </td>
                        <td class="table-action">
                            {{-- <a href="" class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i>
                            </a> --}}
                            <a class="btn btn-success btn-sm data-confirm" href="#" data-target="#confirmData" data-toggle="modal"
                                data-confirmid="{{$dd->id}}" 
                                data-confirmregno="{{$dd->regNo}}"
                                data-confirmname="{{$dd->name}}"
                                >
                                <i class="fa fa-check"></i>
                            </a> 
                            {{-- <a target="_blank" href="{{url('queue/cetak_antrian.php?no_daftar=REG/123123')}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-print"></i>
                            </a> --}}
                            <a target="_blank" href="{{route('cetak-antrian', ['reg_no' => $dd->regNo ])}}" class="btn btn-sm btn-warning">
                                <i class="fa fa-print"></i>
                            </a>
                            <a href="" class="btn btn-sm btn-danger">
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