<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Pasien</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('laborat-edit-submit', ['id' => $dataDetail->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Laborat</label>
                    <input @error('name') style="border:1px solid #ff0000;" @enderror name="name" type="text"
                        value="{{ $dataDetail->name }}" class="form-control" id="name" placeholder="name">
                    @error('name')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input @error('price') style="border:1px solid #ff0000;" @enderror name="price" type="number"
                                value="{{ $dataDetail->price }}" class="form-control" id="price" placeholder="price">
                            @error('price')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lab_category">Kategori Laborat</label>
                            <select @error('lab_category') style="border:1px solid red;" @enderror class="form-control"
                                id="lab_category" name="lab_category">
                                <option value="0" disabled selected>Pilih</option>
                                @foreach ($labCategory as $lc)
                                    <option value="{{ $lc->id }}" @if ($lc->id == $dataDetail->category) selected @endif>
                                        {{ $lc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="normal">Nilai Normal (Contoh : 90 - 140 Mg/dl)</label>
                    <input @error('normal') style="border:1px solid #ff0000;" @enderror name="normal" type="text"
                    value="{{ $dataDetail->normal_value }}" class="form-control" id="normal" placeholder="normal">
                    @error('normal')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-check my-2">
                    <input @if ($dataDetail->status == 1) checked @endif class="form-check-input" id="status" type="checkbox" name="status">
                    <label class="form-check-label" for="status">Data Aktif</label>
                </div>





                {{-- <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="code">Kode Laborat</label>
                            <div  class="form-control">{{ $actCode }}</div>
                            <input name="code" type="text" style="display: none" value="{{ $actCode }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama Laborat</label>
                            <input @error('name') style="border:1px solid #ff0000;" @enderror name="name" type="text"
                                value="{{ old('name') }}" class="form-control" id="name" placeholder="name">
                            @error('name')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="lab_category">Kategori Laborat</label>
                        <select @error('lab_category') style="border:1px solid red;" @enderror class="form-control"
                            id="lab_category" name="lab_category">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($labCategory as $lc)
                                <option value="{{ $lc->id }}">
                                    {{ $lc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="normal">Nilai Normal (Contoh : 90 - 140 Mg/dl)</label>
                            <input @error('normal') style="border:1px solid #ff0000;" @enderror name="normal" type="text"
                                value="{{ old('normal') }}" class="form-control" id="normal" placeholder="normal">
                            @error('normal')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input @error('price') style="border:1px solid #ff0000;" @enderror name="price" type="number"
                                value="{{ old('price') }}" class="form-control" id="price" placeholder="price">
                            @error('price')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>
