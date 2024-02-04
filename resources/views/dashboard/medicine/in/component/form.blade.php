<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Masukkan Stock Baru</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{route('obatmasuk-create')}}">
                @csrf
                <div class="form-group">
                    <label for="medicine">Pilih Obat</label>
                    <livewire:dropdown-medicine />
                </div>
                <div class="form-group">
                    <label for="supplier">Nama Supplier</label>
                    <input @error('supplier') style="border:1px solid #ff0000;" @enderror name="supplier" type="text"
                        value="{{ old('supplier') }}" class="form-control" id="supplier" placeholder="supplier">
                    @error('supplier')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="qty">Jumlah Stock</label>
                    <input @error('qty') style="border:1px solid #ff0000;" @enderror name="qty" type="number"
                        value="{{ old('qty') }}" class="form-control" id="qty" placeholder="qty">
                    @error('qty')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>

