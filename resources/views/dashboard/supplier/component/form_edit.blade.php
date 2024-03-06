<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Supplier</h6>
    </div>
    <div class="card-body">
        <div class="mx-auto">
            <form method="POST" action="{{ route('supplier-edit-submit', ['id'=> $dataDetail->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="supplier">Nama Supplier</label>
                    <input @error('supplier') style="border:1px solid #ff0000;" @enderror name="supplier" type="text"
                        value="{{ $dataDetail->suppliername }}" class="form-control" id="supplier"
                        placeholder="supplier">
                    @error('supplier')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category">Pilih Kategori Supplier</label>
                    <select @error('category') style="border:1px solid red;" @enderror class="form-control" id="category"
                        name="category">
                        <option value="0" selected disabled>Pilih</option>
                        @foreach ($suppCategory as $sc)
                        <option value="{{$sc->id}}" @if ($sc->id == $dataDetail->category) selected @endif>{{$sc->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="officername">Nama Petugas</label>
                            <input @error('officername') style="border:1px solid #ff0000;" @enderror name="officername" type="text"
                                value="{{ $dataDetail->officername }}" class="form-control" id="officername"
                                placeholder="officername">
                            @error('officername')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="officercontact">Kontak Petugas</label>
                            <input @error('officercontact') style="border:1px solid #ff0000;" @enderror name="officercontact" type="text"
                                value="{{ $dataDetail->officercontact }}" class="form-control" id="officercontact"
                                placeholder="officercontact">
                            @error('officercontact')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address">Alamat Pasien</label>
                    <textarea style="resize: none" @error('address') style="border:1px solid #ff0000;" @enderror name="address"
                        type="text" class="form-control" id="address" placeholder="address">{{ $dataDetail->address }}</textarea>
                    @error('address')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>
