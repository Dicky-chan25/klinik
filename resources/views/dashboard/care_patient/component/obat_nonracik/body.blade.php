@include('dashboard.care_patient.component.obat_nonracik.modal_obatnonracik')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <div class="">
            <h5 class="text-primary m-2">Form Obat Non Racikan Pasien</h5>
        </div>
        <div class="">
            <a href="#detailOnr" class="btn btn-info">
                Detail Obat Non Racikan 
                <div class="btn btn-danger btn-sm ml-1">{{$countOnr}}</div>
            </a>
        </div>
    </div>
    <div class="card-body">

        <div class="d-flex">
            <div class="col-lg-2">
                <p>Nomor ID Non Racik</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{ $detailData->onrCode }}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Tanggal</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{ date('d-m-Y', strtotime($detailData->createdAt)) }}</p>
            </div>
        </div>

        <div class="alert alert-success mx-2" id="alertSuccess"></div>
        <div class="alert alert-danger mx-2" id="alertError"></div>


        <div class="d-flex">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Kode Obat</label>
                    <div class="col input-group">
                        {{-- @if ($detailAssesment->code == null)
                        <div class="form-control" id="codeIcd10">Cari Kode Obat</div>
                        @else
                        <div class="form-control" id="codeIcd10">{{ $detailAssesment->code }}</div>
                        @endif --}}
                        <div class="form-control codeMdc">Cari Kode Obat</div>
                        <span class="input-group-text" id="basic-addon2">
                            <a href="#" data-target="#obatNonRacikData" data-toggle="modal">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mdcname" class="col-sm-4 col-form-label">Nama Obat</label>
                    <div class="col-sm-8">
                        <div class="form-control medName">Nama Terisi Otomatis</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rule" class="col-sm-4 col-form-label">Aturan Pakai</label>
                    <div class="col-sm-8">
                        <select name="rule" id="rule" class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($rule as $rl)
                                <option value="{{$rl->title}}">{{$rl->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="price" class="col-sm-4 col-form-label">Harga</label>
                    <div class="col-sm-8">
                        <div class="form-control ppu">Harga Terisi Otomatis</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="qty" class="col-sm-4 col-form-label">Jumlah</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Jumlah">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total_price" class="col-sm-4 col-form-label">Total Harga</label>
                    <div class="col-sm-8">
                        <div class="form-control totalPrice">Total Harga Terisi Otomatis</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-4">
            <div class=" d-flex float-right" style="gap:0.4rem;">
                {{-- <button type="submit" class="btn btn-warning">Reset</button> --}}
                <button type="submit" class="btn btn-primary" id="add-item-onr">Tambah</button>
            </div>
        </div>
        <br>
        <br>
        <form action="{{route('rawatpasien-onr-submit', ['id'=>$id])}}" method="POST">
            @csrf
            <div class="m-2">
                <div class="table table-responsive">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Expired</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Aturan Pakai</th>
                                <th>Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="tableItemOnr"></tbody>
                    </table>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div class=""></div>
                    <div class="d-flex" style="gap:1rem">
                        <p>Total Harga :</p>
                        <h5 class="text-primary" id="totalAllPrice"></h5>
                    </div>
                </div>
                
                <hr>
        
                <div class="form-group row">
                    <label for="desc" class="col-sm-2 col-form-label">Keterangan Tambahan</label>
                    <div class="col-sm-10">
                        <textarea style="resize: none" @error('desc') style="border:1px solid #ff0000;" @enderror name="desc"
                            type="text" value="{{$detailOnr->desc}}" class="form-control" id="desc" placeholder="Keterangan disini">{{$detailOnr->desc}}</textarea>
                        @error('desc')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
    
            <div class="col-lg-12">
                <div class=" d-flex float-right">
                    <button type="submit" style="display: none" id="save-onr"></button>
                    <div id="b4" class="btn btn-primary">Simpan Data</div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('dashboard.care_patient.component.obat_nonracik.table_result')

