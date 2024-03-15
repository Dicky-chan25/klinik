<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Obat Baru</h6>
    </div>
    <div class="card-body">
        <div class="mx-auto">
            <form method="POST" action="{{ route('obat-create-submit') }}">
                @csrf
                <div class="d-flex">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="form-control">{{ $mdcCode }}</div>
                            <input name="code" type="text" style="display: none" value="{{ $mdcCode }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="code_mdc">Kode Obat</label>
                            <input @error('code_mdc') style="border:1px solid #ff0000;" @enderror name="code_mdc" type="text" class="form-control">
                            @error('code_mdc')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mname">Nama Obat</label>
                            <input @error('mname') style="border:1px solid #ff0000;" @enderror name="mname"
                                type="text" value="{{ old('mname') }}" class="form-control" id="mname"
                                placeholder="Nama Obat">
                            @error('mname')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="supplier_id">Pilih Nama Supplier</label>
                            <select class="form-control" id="selectSupplier" name="supplier_id"></select>
                            @error('supplier_id')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nama Petugas</label>
                            <input type="text" class="form-control supplierOfficer" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Kontak Petugas</label>
                            <input type="number" class="form-control supplierContact" disabled>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exp_date">Expired Date</label>
                            <input @error('exp_date') style="border:1px solid #ff0000;" @enderror name="exp_date"
                                type="date" value="{{ old('exp_date') }}" class="form-control" id="exp_date"
                                placeholder="exp_date">
                            @error('exp_date')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="price">Harga Satuan</label>
                            <input @error('price') style="border:1px solid #ff0000;" @enderror name="price"
                                type="number" value="{{ old('price') }}" class="form-control" id="price"
                                placeholder="Harga">
                            @error('price')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input @error('qty') style="border:1px solid #ff0000;" @enderror name="qty" 
                                type="number" value="{{ old('qty') }}" class="form-control" id="qty" placeholder="Jumlah">
                            @error('qty')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="unit">Satuan</label>
                            <select name="unit" class="form-control" id="unit">
                                <option value="" disabled selected>Pilih</option>
                                @foreach ($mUnit as $mu)
                                    <option value="{{$mu->id}}">{{$mu->title}}</option>
                                @endforeach
                            </select>
                            @error('unit')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select name="category" class="form-control" id="category">
                                <option value="" disabled selected>Pilih</option>
                                @foreach ($mCategory as $mc)
                                    <option value="{{$mc->id}}">{{$mc->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-between">
                    <div class=""></div>
                    <button type="submit" name="type" value="0" class="btn btn-primary">Simpan &
                        Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
