@include('dashboard.care_patient.component.assesment.modal_icd10')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <div class="">
            <h5 class="text-primary m-2">Form Assesment Pasien</h5>
        </div>
        <div class="">
            <a class="btn btn-info" href="{{ route('rawatpasien-assesment-result', ['id' => $id]) }}" class="">
                Detail Assesment
            </a>
            @if ($detailAssesment->status_ass == 0)
                <a class="btn btn-warning" href="{{ route('rawatpasien-assesment-close', ['id' => $id]) }}" class="">
                    Selesaikan Assesment 
                </a>
            @endif
        </div>
    </div>
    <div class="card-body">

        <div class="d-flex">
            <div class="col-lg-2">
                <p>Nomor ID Assesment</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{ $detailData->assCode }}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Tanggal</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{ date('d-m-Y', strtotime($detailData->createdAt)) }}</p>
            </div>
        </div>


        <div class="d-flex">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Kode ICD-10</label>
                    <div class="col input-group">
                        @if ($detailAssesment->code == null)
                            <div class="form-control" id="codeIcd10">Cari Kode ICD-10</div>
                        @else
                            <div class="form-control" id="codeIcd10">{{ $detailAssesment->code }}</div>
                        @endif
                        <span class="input-group-text" id="basic-addon2">
                            <a href="#" data-target="#icd10Data" data-toggle="modal">
                                <i class="fa fa-search"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Deskripsi</label>
                    <div class="col-sm-8">
                        @if ($detailAssesment->desc == null)
                            <div class="form-control" id="descIcd10">Deskripsi Terisi Otomatis</div>
                        @else
                            <div class="form-control" id="descIcd10">{{ $detailAssesment->desc }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Diagnosa</label>
                    <div class="col-sm-8">
                        @if ($detailAssesment->title == null)
                            <div class="form-control" id="titleIcd10">Diagnosa ICD-10</div>
                        @else
                            <div class="form-control" id="titleIcd10">{{ $detailAssesment->title }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">DPJP</label>
                    {{-- <label class="col-sm-4 col-form-label">DPJP {{$id}}</label> --}}
                    <div class="col-sm-8">
                        <input type="text" disabled value="{{ $detailData->doctorName }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('rawatpasien-assesment-submit', ['id' => $id]) }}" method="POST">
            @csrf
            <hr>

            <div class="d-flex mx-auto justify-content-between">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="weight">Berat Badan (kg)</label>
                        <input @error('weight') style="border:1px solid #ff0000;" @enderror name="weight"
                            type="number" class="form-control" id="weight" placeholder="Berat"
                            value="{{ $detailAssesment->weight == null ? '' : $detailAssesment->weight }}">
                        @error('weight')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="height">Tinggi Badan (cm)</label>
                        <input @error('height') style="border:1px solid #ff0000;" @enderror name="height"
                            type="number" class="form-control" id="height" placeholder="Height"
                            value="{{ $detailAssesment->height == null ? '' : $detailAssesment->height }}">
                        @error('height')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="temp">Suhu</label>
                        <input @error('temp') style="border:1px solid #ff0000;" @enderror name="temp" 
                            type="number" class="form-control" id="temp" placeholder="Suhu"
                            value="{{ $detailAssesment->temp == null ? '' : $detailAssesment->temp }}">
                        @error('temp')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="blood_press">Tekanan Darah</label>
                        <input @error('blood_press') style="border:1px solid #ff0000;" @enderror name="blood_press"
                            type="number" class="form-control" id="blood_press" placeholder="T. Darah"
                            value="{{ $detailAssesment->bp == null ? '' : $detailAssesment->bp }}">
                        @error('blood_press')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="pulse">Nadi</label>
                        <input @error('pulse') style="border:1px solid #ff0000;" @enderror name="pulse"
                            type="number" class="form-control" id="pulse" placeholder="Nadi"
                            value="{{ $detailAssesment->pulse == null ? '' : $detailAssesment->pulse }}">
                        @error('pulse')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="blood">Jenis Darah</label>
                        <select @error('blood') style="border:1px solid red;" @enderror class="form-control"
                            id="blood" name="blood">
                            <option value="0" disabled selected>Pilih</option>
                            @foreach ($bloods as $bl)
                                <option value="{{ $bl->id }}" 
                                    @if ($bl->id == $detailAssesment->blood)
                                        selected
                                    @endif
                                    >{{ $bl->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <hr>

            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10">
                        <textarea style="resize: none" @error('subject') style="border:1px solid #ff0000;" @enderror name="subject"
                            type="text" class="form-control" id="subject" placeholder="Subject">{{$detailAssesment->subject}}</textarea>
                        @error('subject')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="object" class="col-sm-2 col-form-label">Object</label>
                    <div class="col-sm-10">
                        <textarea style="resize: none" @error('object') style="border:1px solid #ff0000;" @enderror name="object"
                            type="text" class="form-control" id="object" placeholder="Object">{{$detailAssesment->object}}</textarea>
                        @error('object')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="assesment" class="col-sm-2 col-form-label">Assesment</label>
                    <div class="col-sm-10">
                        <textarea style="resize: none" @error('assesment') style="border:1px solid #ff0000;" @enderror name="assesment"
                            type="text" class="form-control" id="assesment" placeholder="Assesment">{{$detailAssesment->assesment}}</textarea>
                        @error('assesment')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="plan" class="col-sm-2 col-form-label">Plan</label>
                    <div class="col-sm-10">
                        <textarea style="resize: none" @error('plan') style="border:1px solid #ff0000;" @enderror name="plan"
                            type="text" class="form-control" id="plan" placeholder="Plan">{{$detailAssesment->plan}}</textarea>
                        @error('plan')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Buta Warna</label>
                        <div class="col-sm-8">
                            <select @error('cb') style="border:1px solid red;" @enderror class="form-control"
                                id="cb" name="cb">
                                @if ($detailAssesment->cb == null)
                                <option value="0" disabled selected>Pilih</option>
                                <option value="1">Iya</option>
                                <option value="2">Tidak</option>
                                @else
                                <option value="1" @if ($detailAssesment->cb == 1) selected @endif>Iya</option>
                                <option value="2" @if ($detailAssesment->cb == 2) selected @endif>Tidak</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class=" d-flex float-right">
                    @if ($detailAssesment->status_ass == 0)
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
