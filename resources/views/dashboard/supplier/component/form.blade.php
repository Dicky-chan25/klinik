<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Daftar Supplier Baru</h6>
    </div>
    <div class="card-body">
        <div class="mx-auto">
            <form method="POST" action="{{ route('supplier-create') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="suppliername">Nama Supplier</label>
                            <input @error('suppliername') style="border:1px solid #ff0000;" @enderror
                                name="suppliername" type="text" value="{{ old('suppliername') }}"
                                class="form-control" id="suppliername" placeholder="suppliername">
                            @error('suppliername')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="category">Pilih Kategori Supplier</label>
                            <select class="form-control" @error('category') style="border:1px solid red;" @enderror name="category" id="category">
                                <option value="" disabled selected>Pilih</option>
                                @foreach ($suppCategory as $sc)
                                    <option value="{{$sc->id}}">{{$sc->title}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="officername">Nama Petugas</label>
                            <input @error('officername') style="border:1px solid #ff0000;" @enderror name="officername"
                                type="text" value="{{ old('officername') }}" class="form-control" id="officername"
                                placeholder="officername">
                            @error('officername')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="officercontact">Kontak Petugas</label>
                            <input @error('officercontact') style="border:1px solid #ff0000;" @enderror
                                name="officercontact" type="number" value="{{ old('officercontact') }}"
                                class="form-control" id="officercontact" placeholder="officercontact">
                            @error('officercontact')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Alamat Supplier</label>
                    <textarea style="resize: none" @error('address') style="border:1px solid #ff0000;" @enderror name="address"
                        type="text" value="{{ old('address') }}" class="form-control" id="address" placeholder="address"></textarea>
                    @error('address')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check my-2">
                    <input class="form-check-input" id="status" type="checkbox" name="status">
                    <label class="form-check-label" for="status">Supplier Aktif</label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>
