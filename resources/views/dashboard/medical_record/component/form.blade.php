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
                        <select @error('poli') style="border:1px solid red;" @enderror class="form-control" id="poli"
                            name="poli">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($polis as $po)
                                <option value="{{ $po->id }}">{{ $po->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                

                {{-- form action and button simpan dan buat resep obat edit by role doctor --}}
                {{-- <div class="form-group">
                    <label for="action">Penanganan</label>
                    <textarea style="resize: none" @error('action') style="border:1px solid #ff0000;" @enderror name="action"
                        type="text" value="{{ old('action') }}" class="form-control" id="action" placeholder="action"></textarea>
                    @error('action')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div> --}}
                
                <div class="justify-content-between d-flex">
                    <button type="submit" name="type" value="0" class="btn btn-info">Simpan & Kembali</button>
                    {{-- <button type="submit" name="type" value="1" class="btn btn-primary">Simpan & Buat Resep Obat</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>
