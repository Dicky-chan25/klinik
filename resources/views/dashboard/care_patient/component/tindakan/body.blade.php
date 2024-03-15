<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <div class="">
            <h5 class="text-primary m-2">Form Tindakan Pasien</h5>
        </div>
        <div class="">
            <a href="{{route('rawatpasien-assesment-result', ['id' => $id])}}" class="btn btn-info">
                Detail Tindakan 
                <div class="btn btn-danger btn-sm ml-1">1</div>
            </a>
            
        </div>
    </div>
    <div class="card-body">

        <div class="d-flex">
            <div class="col-lg-2">
                <p>Nomor ID Tindakan</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{ $detailData->doctorName }}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Tanggal</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: 123123123</p>
            </div>
        </div>


        <div class="d-flex">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Pilih Dokter</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" disabled id="inputPassword"
                            placeholder="Deskripsi Terisi Otomatis">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Kode Tindakan</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Cari Kode ICD-10">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Nama Tindakan</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Harga</label>
                    <div class="col-sm-8">
                        <input type="text" disabled value="{{ $detailData->doctorName }}" class="form-control"
                            id="inputPassword" placeholder="Password">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-4">
            <div class=" d-flex float-right" style="gap:0.4rem;">
                <button type="submit" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
        <br>
        <br>
        <div class="m-2">
            <div class="table table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tindakan</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                        <a href="" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                            
                                        </a>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
    
        </div>

        <div class="col-lg-12">
            <div class=" d-flex float-right">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>
</div>
