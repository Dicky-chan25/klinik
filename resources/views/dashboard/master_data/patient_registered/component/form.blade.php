<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Pendaftaran Pasien Berobat Baru</h6>
    </div>
    <div class="card-body">
        <div class="mx-auto">
            <form method="POST" action="{{ route('pendaftaranpasien-create-submit') }}">
                @csrf
                <div class="d-flex">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="reg_code">Kode Registrasi</label>
                            <div class="form-control" style="background-color: #E9ECF4">{{ $finalReg }}</div>
                            <input name="reg_code" type="text" style="display: none" value="{{ $finalRm }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="rm_code">Kode Rekam Medis</label>
                            <div class="form-control" style="background-color: #E9ECF4">{{ $finalRm }}</div>
                            <input name="rm_code" type="text" style="display: none" value="{{ $finalRm }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="queue_no">Nomor Antrian</label>
                            <div class="form-control" style="background-color: #E9ECF4">{{ $countReg }}</div>
                            <input name="queue_no" type="text" style="display: none" value="{{ $countReg }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex">
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="patient_id">Pilih Nama Pasien</label>
                            <select class="form-control" id="selectPatient" name="patient_id"></select>
                            @error('patient_id')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
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
                <br>
                <button type="submit" class="btn btn-primary float-right">Submit Data</button>
            </form>
        </div>
    </div>
</div>