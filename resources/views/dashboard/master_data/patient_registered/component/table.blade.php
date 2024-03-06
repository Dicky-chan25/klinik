<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Data Pendaftaran Pasien Berobat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @include('dashboard.master_data.patient_registered.component.modal_delete')
            @include('dashboard.master_data.patient_registered.component.modal_filter')

            <div class="d-flex justify-content-between my-2">
                @if ($access->create == 1)
                    <a href="{{ route('pendaftaranpasien-create') }}" class="text-light">
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
                    @include('dashboard.master_data.laboratory.component.search')
                </div>
            </div>

            <table class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. Reg</th>
                        <th>Nama</th>
                        <th>No. Rekam Medis</th>
                        <th>Jenis Kelamin</th>
                        <th>NIK</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th>Antrian</th>
                        <th>Action</th>
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
                        <td>
                            @switch($dd->isSubmit)
                                @case(1)
                                    <div class="btn btn-sm btn-primary">sedang di proses</div>
                                    @break
                                @case(2)
                                    <div class="btn btn-sm btn-warning">sudah di proses</div>
                                    @break
                                @default
                                    <div class="btn btn-sm btn-secondary">Belum di proses</div>
                            @endswitch
                        </td>
                        <td class="table-action">
                            <p style="font-size: 24px;color:red;font-weight:bold">{{$dd->queueNo}}</p>
                        </td>
                        <td>
                            @if ($access->edit == 1)
                                <a href="#" class="btn btn-warning">
                                {{-- <a href="{{route('pendaftaranpasien-edit',['id'=>$aaItem->id ])}}" class="btn btn-warning"> --}}
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            @if ($access->delete == 1)
                                <a class="btn btn-danger data-delete" href="#" data-target="#deleteData" data-toggle="modal"
                                    data-delid="{{$dd->id}}" data-delname="{{$dd->name}}">
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