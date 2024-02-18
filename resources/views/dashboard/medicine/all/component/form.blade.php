<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Obat Baru</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('semuaobat-create') }}">
                @csrf
                <div class="form-group">
                    <label for="code">Kode Obat</label>
                    <div class="form-control">{{ $mdcCode }}</div>
                    <input name="code" type="text" style="display: none" value="{{ $mdcCode }}">
                </div>
                <div class="form-group">
                    <label for="mname">Nama Obat</label>
                    <input @error('mname') style="border:1px solid #ff0000;" @enderror name="mname" type="text"
                        value="{{ old('mname') }}" class="form-control" id="mname" placeholder="mname">
                    @error('mname')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sname">Nama Supplier</label>
                    <input @error('sname') style="border:1px solid #ff0000;" @enderror name="sname" type="text"
                        value="{{ old('sname') }}" class="form-control" id="sname" placeholder="sname">
                    @error('sname')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="scontact">Kontak Supplier</label>
                    <input @error('scontact') style="border:1px solid #ff0000;" @enderror name="scontact" type="number"
                        value="{{ old('scontact') }}" class="form-control" id="scontact" placeholder="scontact">
                    @error('scontact')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" name="type" value="0" class="btn btn-info">Simpan & Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
