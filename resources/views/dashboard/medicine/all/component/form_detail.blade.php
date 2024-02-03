<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Obat</h6>
    </div>
    <div class="card-body row">

        <div class="col-lg-4 mx-4">
            <img style="height: 200px;" src="https://res.cloudinary.com/dk0z4ums3/image/upload/v1692151649/attached_image/sanmol.jpg" alt="">
            <p>Kode Obat</p>
            <p style="margin-top:-16px;font-weight:bolder">{{$dataMdc->code}}</p>
            <hr>
            <p>Nama Obat</p>
            <p style="margin-top:-16px;font-weight:bolder">{{$dataMdc->medicinename}}</p>
            <hr>
            <p>Ditambahkan</p>
            <p style="margin-top:-16px;font-weight:bolder">{{$dataMdc->created_at}}</p>
        </div>
        <div class="col-lg-5 ml-4">
            <form method="POST" action="{{ route('semuaobat-detail-create', ['id' => $id]) }}">
                @csrf
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 48%">
                        <label for="dose">Dosis Obat Sehari</label>
                        <input @error('dose') style="border:1px solid #ff0000;" @enderror name="dose" type="number"
                            value="{{ old('dose') }}" class="form-control" id="dose" placeholder="dose">
                        @error('dose')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="width: 48%">
                        <label for="eating">Baik Diminum Saat</label>
                        <select @error('eating') style="border:1px solid red;" @enderror class="form-control" id="eating"
                            name="eating">
                            <option value="0" disabled selected>Pilih</option>
                            <option value="1">Sebelum Makan</option>
                            <option value="2">Sesudah Makan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age">Kategori Umur</label>
                    <select @error('age') style="border:1px solid red;" @enderror class="form-control" id="age"
                        name="age">
                        {{-- 1->0-17 ; 2->18-65 ; 3->66-79 ; 4->80-99 ; 5->100 ke atas --}}
                        <option value="0" disabled selected>Pilih</option>
                        <option value="1">Umur 0 sampai 17 Tahun</option>
                        <option value="2">Umur 18 sampai 65 Tahun</option>
                        <option value="3">Umur 66 sampai 79 Tahun</option>
                        <option value="4">Umur 80 sampai 99 Tahun</option>
                        <option value="5">Umur 100 ke atas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select @error('category') style="border:1px solid red;" @enderror class="form-control" id="category"
                        name="category">
                        <option value="0" disabled selected>Pilih</option>
                        @foreach ($categoryMdc as $catMdc)
                            <option value="{{ $catMdc->id }}">{{ $catMdc->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="info">Keterangan Tambahan</label>
                    <textarea style="resize: none" @error('info') style="border:1px solid #ff0000;" @enderror name="info"
                        type="text" value="{{ old('info') }}" class="form-control" id="info" placeholder="info"></textarea>
                    @error('info')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah Detail Obat</button>
            </form>
        </div>
    </div>
</div>
