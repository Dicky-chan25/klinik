<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Data Dokter Baru</h6>
    </div>
    <div class="card-body">
        <div class="mx-auto">
            <form method="POST" action="{{ route('dokter-create') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="staff_id">Pilih Nama Pegawai</label>
                            <select class="form-control" id="selectStaff" name="staff_id"></select>
                            @error('staff_id')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Kode Pegawai</label>
                            <input type="text" class="form-control codeStaff" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="str">STR (Surat Tanda Registrasi)</label>
                            <input @error('str') style="border:1px solid #ff0000;" @enderror name="str" type="number"
                                value="{{ old('str') }}" class="form-control" id="str" placeholder="str">
                            @error('str')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sip">SIP (Surat Izin Praktek)</label>
                            <input @error('sip') style="border:1px solid #ff0000;" @enderror name="sip" type="number"
                                value="{{ old('sip') }}" class="form-control" id="sip" placeholder="sip">
                            @error('sip')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="specialize">Spesialisasi</label>
                            <select class="form-control" id="selectSpecialize" name="specialize"></select>
                            @error('specialize')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="price">Komisi Dokter</label>
                            <input @error('price') style="border:1px solid #ff0000;" @enderror value="{{ old('price') }}" type="number" class="form-control" name="price">
                            @error('price')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="user_id">Pilih Akun Teregistrasi</label>
                            <select class="form-control" id="selectUser" name="user_id"></select>
                            @error('user_id')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pic">Upload Foto Dokter</label>
                            <input @error('pic') style="border:1px solid #ff0000;" @enderror type="file" name="pic" id="pic" class="form-control">
                            @error('pic')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="about">Tentang Dokter</label>
                    <textarea @error('about') style="border:1px solid #ff0000;" @enderror name="about" rows="5" type="text"
                        value="{{ old('about') }}" class="form-control" id="about" placeholder="about"></textarea>
                    @error('about')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>
