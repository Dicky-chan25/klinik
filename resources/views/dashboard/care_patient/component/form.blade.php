<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lengkapi Form Di Bawah ini untuk mengisi data pasien</h6>
    </div>
    <br>
    <div class="col-lg-12 mx-4">
        <h5>No. Daftar : <strong>{{ $finalReg }}</strong></h5>
        <h5>Tanggal : <strong>{{ date('d-M-Y') }}</strong></h5>
        <h5>Nomor Antrian : <strong class="text-danger">{{ $countReg }}</strong></h5>
    </div>
    <div class="card-body">
        @include('widget.alert')
        <form action="{{route('pendaftaran-create-submit')}}" method="POST">
            @csrf
            <div class="d-flex mx-auto">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nama Pasien</label>
                        <div class="form-control" style="background-color: #E9ECF4">{{ $detailData->name }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Tempat / Tanggal Lahir</label>
                        <div class="d-flex" style="gap:1rem">
                            <div class="form-control" style="background-color: #E9ECF4">
                                {{ $detailData->birthplace }}</div>
                             style="background-color: #E9ECF4">
                                {{ $detailData->birthdate }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex mx-auto">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Pekerjaan</label>
                        <div class="form-control" style="background-color: #E9ECF4">{{ $detailData->career }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        @if ($detailData->gender == 1)
                            <div class="form-control" style="background-color: #E9ECF4">Pria</div>
                        @else
                            <div class="form-control" style="background-color: #E9ECF4">Wanita</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex mx-auto">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">NIK</label>
                        <div class="form-control" style="background-color: #E9ECF4">123123123123</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nomor HP</label>
                        <div class="form-control" style="background-color: #E9ECF4">0895636701586</div>
                    </div>
                </div>
            </div>
            <div class="d-flex mx-auto">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nomor RM</label>
                        <div class="form-control" style="background-color: #E9ECF4">{{ $finalRm }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Dokter <span style="color:red">*</span></label>
                        <select @error('doctor_id') style="border:1px solid #ff0000;" @enderror class="form-control"
                            name="doctor_id" id="doctor_id">
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($allDoctor as $dr)
                                <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mx-auto">
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea disabled class="form-control" name="" id="" cols="3" style="resize: none">{{ $detailData->address }}</textarea>
                </div>
            </div>
            <div class="my-4">
                <br>
                <hr>
            </div>

            <input type="text" style="opacity: 0%" value="{{ $patientId }}" name="patient_id">
            <input type="text" style="opacity: 0%" value="{{ $finalReg }}" name="reg_code">
            <input type="text" style="opacity: 0%" value="{{ $finalRm }}" name="rm_code">
            <input type="text" style="opacity: 0%" value="{{ $countReg }}" name="queue_no">

            <div class="d-flex mx-auto">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Cara Bayar Pasien</label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            <option value="" disabled selected>Pilih</option>
                            <option value="1">Pribadi</option>
                        </select>
                        @error('payment_method')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Cara Masuk</label>
                        <select class="form-control" name="entry_method" id="entry_method">
                            <option value="" disabled selected>Pilih</option>
                            <option value="1">Datang Sendiri</option>
                        </select>
                        @error('entry_method')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex mx-auto">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Status Rawat</label>
                        <select class="form-control" name="nursing_status" id="nursing_status">
                            <option value="" disabled selected>Pilih</option>
                            <option value="1">Belum Diperiksa</option>
                        </select>
                        @error('nursing_status')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Status Bayar</label>
                        <select class="form-control" name="payment_status" id="payment_status">
                            <option value="" disabled selected>Pilih</option>
                            <option value="1">Belum Bayar</option>
                        </select>
                        @error('payment_status')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Aksi Admin</label>
                        <select class="form-control" name="admin_action" id="admin_action">
                            <option value="" disabled selected>Pilih</option>
                            <option value="1">Proses Data Pasien</option>
                        </select>
                        @error('admin_action')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-12 form-group">
                <label for="">Alergi Obat</label>
                <textarea class="form-control" name="alergy" id="alergy" cols="3"></textarea>
                @error('alergy')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-lg-12">
                <button class="btn btn-primary float-right px-4" type="submit">Daftar Sekarang</button>
            </div>
        </form>
    </div>
</div>
