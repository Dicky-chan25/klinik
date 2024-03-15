<div class="card shadow mb-4" id="detailOr">
    <div class="card-header py-3 d-flex justify-content-between">
        <div class="">
            <h5 class="text-primary m-2">Data List Resep Obat Racik</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="table table-responsive">
            <table id="tableShowOr" class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getDetailOr as $gro)
                        <tr>
                            <td>{{$gro->codeMdc}}</td>
                            <td>{{$gro->nameMdc}}</td>
                            <td>{{$gro->total}}</td>
                            <td>
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
