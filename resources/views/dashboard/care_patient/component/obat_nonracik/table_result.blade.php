<div class="card shadow mb-4" id="detailOnr">
    <div class="card-header py-3 d-flex justify-content-between">
        <div class="">
            <h5 class="text-primary m-2">Data List Resep Obat Non Racik</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="table table-responsive">
            <table id="tableShowOnr" class="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Expired</th>
                        <th>Aturan Pakai</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getDetailOnr as $gdo)
                        <tr>
                            <td>{{$gdo->codeMdc}}</td>
                            <td>{{$gdo->nameMdc}}</td>
                            <td>{{$gdo->expDate}}</td>
                            <td>{{$gdo->rule}}</td>
                            <td>{{$gdo->unit}}</td>
                            <td>{{$gdo->ppu}}</td>
                            <td>{{$gdo->qty}}</td>
                            <td>{{$gdo->total}}</td>
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
