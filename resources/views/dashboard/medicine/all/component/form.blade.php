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
                {{-- <button type="submit" class="btn btn-primary">Simpan & Kembali</button> --}}
                <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
            </form>
        </div>
    </div>
</div>
