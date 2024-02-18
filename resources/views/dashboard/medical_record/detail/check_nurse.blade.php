<form  method="POST" action="{{ route('rekammedis-v2-periksa-nurse', ['id' => $id]) }}">
    @csrf
    <div id="soapAdmin" class="collapse"  data-parent="#accordionSidebar">
        <p class="text-primary" style="font-weight: bold">Vital Sign*</p>
        <div class="form-group" style="gap: 10px; display:flex">
            <div class="">
                <label for="">Berat Badan</label>
                <div class="d-flex">
                    <input name="weight" @error('weight') style="border:1px solid #ff0000;" @enderror type="number" class="form-control">
                    <div class="mx-2 mt-2">
                        <p>KG</p>
                    </div>
                </div>
                @error('weight')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="">Tinggi Badan</label>
                <div class="d-flex">
                    <input name="height" @error('height') style="border:1px solid #ff0000;" @enderror type="number" class="form-control">
                    <div class="mx-2 mt-2">
                        <p>CM</p>
                    </div>
                </div>
                @error('height')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="">Tekanan Darah (<span>Prehipertensi</span>)</label>
                <div class="d-flex">
                    <div class="">
                        <input name="bloodpress" @error('bloodpress') style="border:1px solid #ff0000;" @enderror type="number" class="form-control">
                    </div>
                    <div class="mx-2 mt-2">
                        <p>/</p>
                    </div>
                    <div class="d-flex">
                        <input name="bloodpress2" @error('bloodpress2') style="border:1px solid #ff0000;" @enderror type="number" class="form-control">
                        <div class="mx-2 mt-2">
                            <p>Kali</p>
                        </div>
                    </div>
                </div>
                @error('bloodpress')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="">Heart Rate (<span>Normal</span>)</label>
                <div class="d-flex">
                    <input name="heartrate" @error('heartrate') style="border:1px solid #ff0000;" @enderror type="number" class="form-control">
                    <div class="mx-2 mt-2">
                        <p>Kali</p>
                    </div>
                </div>
                @error('heartrate')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group" style="gap: 10px; display:flex;margin-top:-14px;">
            <div class="">
                <label for="">Resp Rate</label>
                <div class="d-flex">
                    <input name="resprate" type="number" class="form-control" @error('resprate') style="border:1px solid #ff0000;" @enderror>
                    <div class="mx-2 mt-2">
                        <p>Kali</p>
                    </div>
                </div>
                @error('resprate')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="">Temp (<span>Normal</span>)</label>
                <div class="d-flex">
                    <input name="temp" type="number" class="form-control" @error('temp') style="border:1px solid #ff0000;" @enderror>
                    <div class="mx-2 mt-2">
                        <p>*C</p>
                    </div>
                </div>
                @error('temp')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="">Sp02</label>
                <div class="d-flex">
                    <input name="sp" type="number" class="form-control" @error('sp') style="border:1px solid #ff0000;" @enderror>
                    <div class="mx-2 mt-2">
                        <p>%</p>
                    </div>
                </div>
                @error('sp')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <label for="">Gula Darah</label>
                <div class="d-flex">
                    <input name="bloodsugar" type="number" class="form-control" @error('bloodsugar') style="border:1px solid #ff0000;" @enderror>
                    <div class="mx-2 mt-2">
                        <p>mg/dL</p>
                    </div>
                </div>
                @error('bloodsugar')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Keluhan / Anamnesis Keperawatan*</p>
            <textarea @error('anamnesis') style="border:1px solid #ff0000;" @enderror name="anamnesis" type="text"
                value="{{ old('anamnesis') }}" class="form-control" id="anamnesis" placeholder="anamnesis">{{ old('anamnesis') }}</textarea>
            @error('anamnesis')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Pemeriksaan Fisik Keperawatan*</p>
            <textarea @error('physicalcheck') style="border:1px solid #ff0000;" @enderror name="physicalcheck" type="text"
                value="{{ old('physicalcheck') }}" class="form-control" id="physicalcheck" placeholder="physicalcheck">{{ old('physicalcheck') }}</textarea>
            @error('physicalcheck')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Diagnosis Keperawatan*</p>
            <textarea @error('diagnosis') style="border:1px solid #ff0000;" @enderror name="diagnosis" type="text"
                value="{{ old('diagnosis') }}" class="form-control" id="diagnosis" placeholder="diagnosis">{{ old('diagnosis') }}</textarea>
            @error('diagnosis')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="d-flex justify-content-between">
            <div class=""></div>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </div>
</form>

