<div class="card shadow mb-4">
   
    {{-- @livewire('dashboard.medical_record.component.dropdown_patient'); --}}
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Daftar Resep</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('rekammedis-create-resep', ['id' => $idMr]) }}">
                @csrf
                <div class="form-group">
                    {{-- <label for="code">Kode Resep Obat</label> --}}
                    <input name="code" type="text" style="display: none" value="{{ $mCode }}">
                </div>
                <livewire:dropdown-prescription />
                <div class="form-group">
                    <label for="qty">Jumlah Obat</label>
                    <input @error('qty') style="border:1px solid #ff0000;" @enderror name="qty"
                        type="number" value="{{ old('qty') }}" class="form-control" id="qty"
                        placeholder="qty">
                    @error('qty')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="info">Informasi Tambahan</label>
                    <textarea style="resize: none" @error('info') style="border:1px solid #ff0000;" @enderror name="info"
                        type="text" class="form-control" id="info" placeholder="info">{{ old('info') }}</textarea>
                    @error('info')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>

                <br>
                <div class="justify-content-between d-flex">
                    <div class=""></div>
                    <button type="submit" class="btn btn-primary">Simpan & Buat Resep Obat</button>
                </div>
            </form>
        </div>
    </div>
</div>
