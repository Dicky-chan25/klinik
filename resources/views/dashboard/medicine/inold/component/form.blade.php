<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Masukkan Stock Baru</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-8 mx-auto">
            <form method="POST" action="{{ route('obatmasuk-create') }}">
                @csrf
                <div class="form-group">
                    <label for="medicine">Pilih Obat</label>
                    <livewire:dropdown-medicine />
                </div>

                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 49%">
                        <label for="noreg">Nomor Registrasi</label>
                        <input @error('noreg') style="border:1px solid #ff0000;" @enderror name="noreg" type="text"
                            value="{{ old('noreg') }}" class="form-control" id="noreg" placeholder="noreg">
                        @error('noreg')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="width: 49%">
                        <label for="nobatch">Nomor Batch</label>
                        <input @error('nobatch') style="border:1px solid #ff0000;" @enderror name="nobatch"
                            type="text" value="{{ old('nobatch') }}" class="form-control" id="nobatch"
                            placeholder="nobatch">
                        @error('nobatch')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 49%">
                        <label for="pdate">Tanggal Produksi</label>
                        <p class="text-primary" style="font-size:11px">Note :
                            Jika waktu Produksi obat hanya dinyatakan dalam bulan dan tahun, maka waktu kadaluwarsa
                            adalah hari terakhir bulan yang dinyatakan</p>
                        <input @error('pdate') style="border:1px solid #ff0000;" @enderror name="pdate" type="date"
                            value="{{ old('pdate') }}" class="form-control" id="pdate" placeholder="pdate">
                        @error('pdate')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="width: 49%">
                        <label for="expdate">Tanggal Kadaluarsa</label>
                        <p class="text-primary" style="font-size:11px">Note :
                            Jika waktu kadaluwarsa obat hanya dinyatakan dalam bulan dan tahun, maka waktu kadaluwarsa
                            adalah hari terakhir bulan yang dinyatakan</p>
                        <input @error('expdate') style="border:1px solid #ff0000;" @enderror name="expdate" type="date"
                            value="{{ old('expdate') }}" class="form-control" id="expdate" placeholder="expdate">
                        @error('expdate')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 49%">
                        <label for="price">Harga Asli</label>
                        <input @error('price') style="border:1px solid #ff0000;" @enderror name="price" type="number"
                            value="{{ old('price') }}" class="form-control" id="price" placeholder="price">
                        @error('price')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="width: 49%">
                        <label for="het">HET (Harga Eceran Tertinggi)</label>
                        <input @error('het') style="border:1px solid #ff0000;" @enderror name="het" type="number"
                            value="{{ old('het') }}" class="form-control" id="het" placeholder="het">
                        @error('het')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="shape">Bentuk Obat</label>
                    <select @error('shape') style="border:1px solid red;" @enderror class="form-control"
                        id="shape" name="shape">
                        <option value="0" disabled selected>Pilih</option>
                        @foreach ($mShape as $ms)
                            <option value="{{ $ms->id }}">{{ $ms->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 24%">
                        <label for="category">Jenis Obat</label>
                        <select @error('category') style="border:1px solid red;" @enderror class="form-control"
                            id="category" name="category">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($categoryMdc as $catMdc)
                                <option value="{{ $catMdc->id }}">{{ $catMdc->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="width: 24%">
                        <label for="unit">Satuan Unit</label>
                        <select @error('unit') style="border:1px solid red;" @enderror class="form-control" id="unit" name="unit">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($mUnit as $un)
                                <option value="{{ $un->id }}">{{ $un->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="width: 24%">
                        <label for="weight">Berat Per Satuan (Mg)</label>
                        <input @error('weight') style="border:1px solid #ff0000;" @enderror name="weight" type="text"
                            value="{{ old('weight') }}" class="form-control" id="weight" placeholder="weight">
                        @error('weight')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" style="width: 24%">
                        <label for="qty">Jumlah Stock</label>
                        <input @error('qty') style="border:1px solid #ff0000;" @enderror name="qty" type="number"
                            value="{{ old('qty') }}" class="form-control" id="qty" placeholder="qty">
                        @error('qty')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr>

                <table class="table table-sm table-bordered">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col" class="text-center">Umur</th>
                            <th scope="col" class="text-center">Dosis Min</th>
                            <th scope="col" class="text-center">Dosis Maks</th>
                            <th scope="col" class="text-center">Diminum</th>
                            <th scope="col" class="text-center">
                                <div id="add" class="btn btn-info btn-sm text-light"><i
                                        class="fas fa-plus"></i></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        {{-- Form Table --}}
                        <tr>
                            <td style="max-width:180px">
                                <select class="form-control" name="inputs[0][age]">
                                    @foreach ($mAgeRange as $mAr)
                                        <option value="{{ $mAr->id }}">{{ $mAr->agename }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="max-width:40px">
                                <input type="number" name="inputs[0][dosemin]" class="form-control">
                            </td>
                            <td style="max-width:40px">
                                <input type="number" name="inputs[0][dosemax]" class="form-control">
                            </td>
                            <td style="max-width:70px">
                                <select @error('eating') style="border:1px solid red;" @enderror class="form-control"
                                    name="inputs[0][eating]">
                                    <option value="0" disabled selected>Pilih</option>
                                    <option value="1">Sebelum Makan</option>
                                    <option value="2">Sesudah Makan</option>
                                </select>
                            </td>
                            <td class="text-center" style="width:100px">
                                <div class="m-1">
                                    <div id="remove" class="btn btn-danger btn-sm text-light"><i
                                            class="fas fa-trash"></i></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <div class="d-flex justify-content-between">
                    <div class=""></div>
                    <button type="submit" class="btn btn-primary">Submit Stock Obat</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script>
        var i = 0;
        $(document).on('click', '#remove', function() {
            $(this).parents('tr').remove();
        })

        $('#add').click(function() {
            ++i;
            $('#table').append(`
            <tr>
                <td style="max-width:180px">
                    <select class="form-control" name="inputs[${i}][age]">
                        @foreach ($mAgeRange as $mAr)
                            <option value="{{ $mAr->id }}">{{ $mAr->agename }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="max-width:40px">
                    <input type="number" name="inputs[${i}][dosemin]" class="form-control">
                </td>
                <td style="max-width:40px">
                    <input type="number" name="inputs[${i}][dosemax]" class="form-control">
                </td>
                <td style="max-width:70px">
                    <select @error('eating') style="border:1px solid red;" @enderror class="form-control"
                        name="inputs[${i}][eating]">
                        <option value="0" disabled selected>Pilih</option>
                        <option value="1">Sebelum Makan</option>
                        <option value="2">Sesudah Makan</option>
                    </select>
                </td>
                <td class="text-center" style="width:100px">
                    <div class="m-1">
                        <div id="remove" class="btn btn-danger btn-sm text-light"><i class="fas fa-trash"></i></div>
                    </div>
                </td>
            </tr>
            `)
        })
    </script>
@endsection
