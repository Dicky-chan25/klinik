<div class="card shadow mb-4">
   
    {{-- @livewire('dashboard.medical_record.component.dropdown_patient'); --}}
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Daftar Pasien Baru</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('rekammedis-create') }}">
                @csrf
                <div class="form-group">
                    <label for="code">Kode Resep Obat</label>
                    <input name="code" type="text" disabled value="{{ $mCode }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="medicine">Pilih Obat</label>
                    <livewire:dropdown-medicine />
                </div>

                <div class="form-group">
                    <label for="qty">qty</label>
                    <input @error('qty') style="border:1px solid #ff0000;" @enderror name="qty"
                        type="number" value="{{ old('qty') }}" class="form-control" id="qty"
                        placeholder="qty">
                    @error('qty')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rule">Informasi Resep</label>
                    <textarea style="resize: none" @error('rule') style="border:1px solid #ff0000;" @enderror name="rule"
                        type="text" value="{{ old('rule') }}" class="form-control" id="rule" placeholder="rule"></textarea>
                    @error('rule')
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
