<div class="card shadow mb-4">
   
    {{-- @livewire('dashboard.medical_record.component.dropdown_patient'); --}}
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Rekam Medis</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('rekammedis-create') }}">
                @csrf
                <div class="form-group">
                    <label for="code">Kode Rekam Medis</label>
                    <div  class="form-control">{{ $rmCode }}</div>
                    <input name="code" type="text" style="display: none" value="{{ $rmCode }}">
                </div>
                <div class="form-group">
                    <label for="patient">Nama Pasien</label>
                    <livewire:dropdown-patient>
                </div>
                <div class="form-group">
                    <label for="doctor">Nama Dokter</label>
                    <select @error('doctor') style="border:1px solid red;" @enderror class="form-control" id="doctor"
                        name="doctor">
                        <option value="0" disabled selected>Pilih</option>
                        @foreach ($doctors as $doc)
                            <option value="{{ $doc->id }}">{{ $doc->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="service">Pilih Layanan</label>
                    <select @error('service') style="border:1px solid red;" @enderror class="form-control"
                        id="service" name="service">
                        <option value="0" disabled selected>Pilih</option>
                        @foreach ($services as $ser)
                            <option value="{{ $ser->id }}">{{ $ser->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row mx-auto justify-content-between">
                    <div class="form-group" style="width:45%">
                        <label for="poli">Jenis Poli</label>
                        <select @error('poli') style="border:1px solid red;" @enderror class="form-control" id="poli"
                            name="poli">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($polis as $po)
                                <option value="{{ $po->id }}">{{ $po->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="width:45%">
                        <label for="blood">Jenis Darah</label>
                        <select @error('blood') style="border:1px solid red;" @enderror class="form-control" id="blood"
                            name="blood">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($bloods as $bl)
                                <option value="{{ $bl->id }}">{{ $bl->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group">
                        <label for="weight">Berat Badan (kg)</label>
                        <input @error('weight') style="border:1px solid #ff0000;" @enderror name="weight"
                            type="number" value="{{ old('weight') }}" class="form-control" id="weight"
                            placeholder="weight">
                        @error('weight')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="height">Tinggi Badan (cm)</label>
                        <input @error('height') style="border:1px solid #ff0000;" @enderror name="height"
                            type="number" value="{{ old('height') }}" class="form-control" id="height"
                            placeholder="height">
                        @error('height')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="waist">Lingkar Pinggang</label>
                        <input @error('waist') style="border:1px solid #ff0000;" @enderror name="waist" type="number"
                            value="{{ old('waist') }}" class="form-control" id="waist" placeholder="waist">
                        @error('waist')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="complain">Anamnesis / Keluhan Pasien</label>
                    <textarea style="resize: none" @error('complain') style="border:1px solid #ff0000;" @enderror name="complain"
                        type="text" value="{{ old('complain') }}" class="form-control" id="complain" placeholder="complain"></textarea>
                    @error('complain')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="diagnose">Diagnosis</label>
                    <textarea style="resize: none" @error('diagnose') style="border:1px solid #ff0000;" @enderror name="diagnose"
                        type="text" value="{{ old('diagnose') }}" class="form-control" id="diagnose" placeholder="diagnose"></textarea>
                    @error('diagnose')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="action">Penanganan</label>
                    <textarea style="resize: none" @error('action') style="border:1px solid #ff0000;" @enderror name="action"
                        type="text" value="{{ old('action') }}" class="form-control" id="action" placeholder="action"></textarea>
                    @error('action')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>

                <br>
                
                <div class="justify-content-between d-flex">
                    <button type="submit" name="type" value="0" class="btn btn-info">Simpan & Kembali</button>
                    <button type="submit" name="type" value="1" class="btn btn-primary">Simpan & Buat Resep Obat</button>
                </div>
            </form>
        </div>
    </div>
</div>
