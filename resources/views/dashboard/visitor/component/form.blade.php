<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Daftar Pasien Baru</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('antrian-create') }}">
                @csrf
                <div class="form-group">
                    <label for="code">Nomor Registrasi Kunjungan</label>
                    <div class="form-control">{{ $noReg }}</div>
                    <input type="text" value="{{ $noReg }}" style="display: none" name="noreg">
                </div>
                <div class="form-group">
                    <label for="code">Nomor Kunjungan</label>
                    <div class="form-control">{{ $noVisitor }}</div>
                    <input type="text" value="{{ $noVisitor }}" style="display: none" name="novisitor">
                </div>
                <div class="form-group">
                    <label for="patient">Pilih Pasien</label>
                    <livewire:dropdown-patient>
                        @error('patient')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                </div>
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 49%">
                        <label for="service">Pilih Layanan</label>
                        <select @error('service') style="border:1px solid red;" @enderror class="form-control"
                            id="service" name="service">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($services as $ser)
                                <option value="{{ $ser->id }}">{{ $ser->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="width: 49%">
                        <label for="poli">Jenis Poli</label>
                        <select @error('poli') style="border:1px solid red;" @enderror class="form-control"
                            id="poli" name="poli">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($polis as $po)
                                <option value="{{ $po->id }}">{{ $po->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="width: 49%">
                        <label for="payment">Jenis Pembayaran</label>
                        <select @error('payment') style="border:1px solid red;" @enderror class="form-control"
                            id="payment" name="payment">
                            <option value="0" disabled selected>Pilih</option>
                            <option value="1">Tunai</option>
                            <option value="2">Transfer</option>
                            <option value="3">BPJS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fdiagnose">Diagnosa Pertama</label>
                    <textarea @error('fdiagnose') style="border:1px solid #ff0000;" @enderror name="fdiagnose" rows="5" type="text"
                        value="{{ old('fdiagnose') }}" class="form-control" id="fdiagnose" placeholder="fdiagnose"></textarea>
                    @error('fdiagnose')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <br>
                <br>
                <div class="justify-content-between d-flex">
                    <div class=""></div>
                    <button type="submit" name="type" value="1" class="btn btn-primary">Buat Kunjungan
                        Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>
