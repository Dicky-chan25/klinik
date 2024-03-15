<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Keluarkan Stock</h6>
    </div>
    <div class="card-body">
        {{-- <div class="col-lg-6 mr-auto mb-4">
            <ul class="nav nav-pills">
                <li class="nav-item" style="cursor: pointer">
                  <p class="nav-link per-item">Per Item</p>
                </li>
                <li class="nav-item per-qty" style="cursor: pointer">
                    <p class="nav-link per-qty">Per Kuantiti</p>
                </li>
              </ul>
        </div> --}}
        <div class="d-flex justify-content-between">
            <div class="col-lg-6 mr-auto">
                <h5>Keluarkan Item berdasarkan Barcode</h5>
                <form method="POST" action="{{route('obatkeluar-peritem')}}">
                    @csrf
                    <div class="form-group">
                        <label for="barcode">Barcode</label>
                        <input @error('barcode') style="border:1px solid #ff0000;" @enderror name="barcode" type="text"
                            value="{{ old('barcode') }}" class="form-control" id="barcode" placeholder="barcode">
                        @error('barcode')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class=""></div>
                        <button type="submit" class="btn btn-info">Submit Item</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 mr-auto">
                <h5>Keluarkan Item berdasarkan Kuantiti</h5>
                <form method="POST" action="{{route('obatkeluar-perqty')}}">
                    @csrf
                    <div class="form-group">
                        <label for="medicine">Nama Obat</label>
                        <livewire:dropdown-medicine>
                    </div>
                    <div class="form-group">
                        <label for="qty">Jumlah Item</label>
                        <input @error('qty') style="border:1px solid #ff0000;" @enderror name="qty" type="number"
                            value="{{ old('qty') }}" class="form-control" id="qty" placeholder="qty">
                        @error('qty')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class=""></div>
                        <button type="submit" class="btn btn-info">Submit Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


