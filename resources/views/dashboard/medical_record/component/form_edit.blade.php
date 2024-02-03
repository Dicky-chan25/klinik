<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Pasien</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('pasien-edit-submit', ['id'=> $dataDetail->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="fullname">Nama Lengkap Sesuai KTP</label>
                    <input @error('fullname') style="border:1px solid #ff0000;" @enderror name="fullname" type="text"
                        value="{{ $dataDetail->patientname }}" class="form-control" id="fullname"
                        placeholder="fullname">
                    @error('fullname')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="identity">NIK Sesuai KTP</label>
                    <input @error('identity') style="border:1px solid #ff0000;" @enderror name="identity" type="number"
                        value="{{ $dataDetail->identity }}" class="form-control" id="identity" placeholder="identity" disabled>
                    @error('identity')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bpjs">Nomor BPJS (opsional)</label>
                    <input @error('bpjs') style="border:1px solid #ff0000;" @enderror name="bpjs" type="number"
                        value="{{ $dataDetail->bpjs_number }}" class="form-control" id="bpjs" placeholder="bpjs">
                    @error('bpjs')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select @error('gender') style="border:1px solid red;" @enderror class="form-control" id="gender"
                        name="gender">
                        <option value="0" selected disabled>Pilih</option>
                        <option value="1" @if (1 == $dataDetail->gender) selected @endif>Pria</option>
                        <option value="2" @if (2 == $dataDetail->gender) selected @endif>Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birthplace">Tempat Lahir</label>
                    <input @error('birthplace') style="border:1px solid #ff0000;" @enderror name="birthplace"
                        type="text" value="{{ $dataDetail->birthplace }}" class="form-control" id="birthplace"
                        placeholder="birthplace">
                    @error('birthplace')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="birthdate">Tanggal Lahir</label>
                    <input @error('birthdate') style="border:1px solid #ff0000;" @enderror name="birthdate"
                        type="date" value="{{ $dataDetail->birthdate }}" class="form-control" id="birthdate"
                        placeholder="birthdate">
                    @error('birthdate')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="religion">Agama</label>
                    <select @error('religion') style="border:1px solid red;" @enderror class="form-control"
                        id="religion" name="religion">
                        <option value="0" disabled selected>Pilih</option>
                        @foreach ($religion as $reli)
                            <option value="{{ $reli->id }}" @if ($reli->id == $dataDetail->religion_id) selected @endif>
                                {{ $reli->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="career">Pekerjaan</label>
                    <select @error('career') style="border:1px solid red;" @enderror class="form-control"
                        id="career" name="career">
                        <option value="0" disabled selected>Pilih</option>
                        @foreach ($career as $car)
                            <option value="{{ $car->id }}" @if ($car->id == $dataDetail->career_id) selected @endif>
                                {{ $car->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="education">Pendidikan</label>
                    <select @error('education') style="border:1px solid red;" @enderror class="form-control"
                        id="education" name="education">
                        <option value="0" disabled selected>Pilih</option>
                        @foreach ($education as $edu)
                            <option value="{{ $edu->id }}" @if ($edu->id == $dataDetail->education_id) selected @endif>
                                {{ $edu->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="wa">Nomor Telp / WA</label>
                    <input @error('wa') style="border:1px solid #ff0000;" @enderror name="wa" type="number"
                        value="{{ $dataDetail->phone }}" class="form-control" id="wa" placeholder="wa">
                    @error('wa')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input @error('email') style="border:1px solid #ff0000;" @enderror name="email" type="email"
                        value="{{ $dataDetail->email }}" class="form-control" id="email" placeholder="email">
                    @error('email')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Alamat Pasien</label>
                    <textarea style="resize: none" @error('address') style="border:1px solid #ff0000;" @enderror name="address"
                        type="text" class="form-control" id="address" placeholder="address">{{ $dataDetail->address }}</textarea>
                    @error('address')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>
