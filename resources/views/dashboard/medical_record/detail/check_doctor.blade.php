@include('dashboard.medical_record.detail.modal_form.prescript')
@include('dashboard.medical_record.detail.modal_form.lab')
@include('dashboard.medical_record.detail.modal_form.radio')
@include('dashboard.medical_record.detail.modal_form.me')
@include('dashboard.medical_record.detail.modal_form.cppt')
@include('dashboard.medical_record.detail.modal_letter.rujukan')
{{-- <div> --}}
<div id="soapAdmin" class="collapse">
    <form action="{{ route('rekammedis-v2-periksa', ['id' => $id]) }}" method="POST">
        <p class="text-primary" style="font-weight: bold">Vital Sign*</p>
        <div class="form-group" style="gap: 10px; display:flex">
            <div class="">
                <label for="">Berat Badan</label>
                <div class="d-flex">
                    <input disabled value="{{ $mrNurse->vs_w }}" name="weight"
                        @error('weight') style="border:1px solid #ff0000;" @enderror type="number"
                        class="form-control">
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
                    <input disabled value="{{ $mrNurse->vs_h }}" name="height"
                        @error('height') style="border:1px solid #ff0000;" @enderror type="number"
                        class="form-control">
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
                    @php
                        $explodeBp = explode('/', $mrNurse->vs_bp);
                    @endphp
                    <div class="">
                        <input disabled value="{{ $explodeBp[0] }}" name="bloodpress"
                            @error('bloodpress') style="border:1px solid #ff0000;" @enderror type="number"
                            class="form-control">
                    </div>
                    <div class="mx-2 mt-2">
                        <p>/</p>
                    </div>
                    <div class="d-flex">
                        <input disabled value="{{ $explodeBp[1] }}" name="bloodpress2"
                            @error('bloodpress2') style="border:1px solid #ff0000;" @enderror type="number"
                            class="form-control">
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
                    <input disabled value="{{ $mrNurse->vs_hr }}" name="heartrate"
                        @error('heartrate') style="border:1px solid #ff0000;" @enderror type="number"
                        class="form-control">
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
                    <input disabled value="{{ $mrNurse->vs_rr }}" name="resprate" type="number" class="form-control"
                        @error('resprate') style="border:1px solid #ff0000;" @enderror>
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
                    <input disabled value="{{ $mrNurse->vs_temp }}" name="temp" type="number" class="form-control"
                        @error('temp') style="border:1px solid #ff0000;" @enderror>
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
                    <input disabled value="{{ $mrNurse->vs_sp }}" name="sp" type="number" class="form-control"
                        @error('sp') style="border:1px solid #ff0000;" @enderror>
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
                    <input disabled value="{{ $mrNurse->vs_bs }}" name="bloodsugar" type="number" class="form-control"
                        @error('bloodsugar') style="border:1px solid #ff0000;" @enderror>
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
            <p style="font-weight: bold">Keluhan / Anamnesis Keperawatan</p>
            <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $mrNurse->anamnesis }}</textarea>
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Keluhan / Anamnesis*</p>
            <textarea @error('action') style="border:1px solid #ff0000;" @enderror name="action" type="text"
                value="{{ old('action') }}" class="form-control" id="action" placeholder="action">{{ old('action') }}</textarea>
            @error('action')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <p style="font-weight: bold">Pemeriksaan Fisik Keperawatan*</p>
            <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $mrNurse->physical_check }}</textarea>
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Pemeriksaan Fisik*</p>
            <textarea @error('action') style="border:1px solid #ff0000;" @enderror name="action" type="text"
                value="{{ old('action') }}" class="form-control" id="action" placeholder="action">{{ old('action') }}</textarea>
            @error('action')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <p style="font-weight: bold">Diagnosis Keperawatan</p>
            <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $mrNurse->diagnosis }}</textarea>
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Diagnosis*</p>
            <textarea @error('action') style="border:1px solid #ff0000;" @enderror name="action" type="text"
                value="{{ old('action') }}" class="form-control" id="action" placeholder="action">{{ old('action') }}</textarea>
            @error('action')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Penyebab Cedera / External Cause*</p>
            <textarea @error('action') style="border:1px solid #ff0000;" @enderror name="action" type="text"
                value="{{ old('action') }}" class="form-control" id="action" placeholder="action">{{ old('action') }}</textarea>
            @error('action')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>

        <hr>
        <div class="d-flex justify-content-between">
            <div class="" style="width:24%;">
                <a id="openPrescriptModal">
                    <div
                        style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                        Resep Online</div>
                </a>
                <p id="prescriptItem"></p>
                <p id="preLoading"></p>
                <div class="prescript-item-head">
                    <div class="prescript-item"></div>
                </div>
            </div>
            <div class="" style="width:24%;">
                <a id="openLabModal">
                    <div
                        style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                        Permintaan Lab</div>
                </a>
                <p id="labItem"></p>
                <p id="labLoading"></p>
                <div class="lab-item-head">
                    <div class="lab-item"></div>
                </div>
            </div>

            <div class="" style="width:24%;">
                <a id="openRadioModal">
                    <div
                        style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                        Permintaan Radiologi</div>
                </a>
                <p id="radioItem"></p>
                <p id="radioLoading"></p>
                <div class="radio-item-head">
                    <div class="radio-item"></div>
                </div>
            </div>

            <div class="" style="width:24%;">
                <a id="openMeModal">
                    <div
                        style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                        Permintaan Alat Kesehatan</div>
                </a>
                <p id="meItem"></p>
                <p id="meLoading"></p>
                <div class="me-item-head">
                    <div class="me-item"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Tindakan*</p>
            <textarea @error('action') style="border:1px solid #ff0000;" @enderror name="action" type="text"
                value="{{ old('action') }}" class="form-control" id="action" placeholder="action">{{ old('action') }}</textarea>
            @error('action')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Rencana*</p>
            <textarea @error('action') style="border:1px solid #ff0000;" @enderror name="action" type="text"
                value="{{ old('action') }}" class="form-control" id="action" placeholder="action">{{ old('action') }}</textarea>
            @error('action')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <p class="text-primary" style="font-weight: bold">Anjuran*</p>
            <textarea @error('action') style="border:1px solid #ff0000;" @enderror name="action" type="text"
                value="{{ old('action') }}" class="form-control" id="action" placeholder="action">{{ old('action') }}</textarea>
            @error('action')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="d-flex justify-content-between">
            <div class=""></div>
            <button class="btn btn-primary" type="submit">Simpan Data</button>
        </div>
    </form>
    <div class="mt-4">
        <hr>
    </div>
    @include('dashboard.medical_record.detail.table_form.table_icd9')
    @include('dashboard.medical_record.detail.table_form.table_icd10')
</div>
