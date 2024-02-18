<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Daftar Pasien Baru</h6>
    </div>
    <div class="card-body">
        <div class="mx-auto">
            <form method="POST" action="{{ route('pegawai-create') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama Lengkap Sesuai KTP</label>
                            <input @error('name') style="border:1px solid #ff0000;" @enderror name="name" type="text"
                                value="{{ old('name') }}" class="form-control" id="name" placeholder="name">
                            @error('name')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="identity">NIK Sesuai KTP</label>
                            <input @error('identity') style="border:1px solid #ff0000;" @enderror name="identity" type="number"
                                value="{{ old('identity') }}" class="form-control" id="identity" placeholder="identity">
                            @error('identity')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select @error('gender') style="border:1px solid red;" @enderror class="form-control"
                                id="gender" name="gender">
                                <option value="0" selected disabled>Pilih</option>
                                <option value="1">Pria</option>
                                <option value="2">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="birthplace">Tempat Lahir</label>
                            <input @error('birthplace') style="border:1px solid #ff0000;" @enderror name="birthplace" type="text"
                                value="{{ old('birthplace') }}" class="form-control" id="birthplace" placeholder="birthplace">
                            @error('birthplace')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input @error('birthdate') style="border:1px solid #ff0000;" @enderror name="birthdate" type="date"
                                value="{{ old('birthdate') }}" class="form-control" id="birthdate" placeholder="birthdate">
                            @error('birthdate')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="role">Posisi Pekerjaan</label>
                            <select @error('role') style="border:1px solid red;" @enderror class="form-control"
                                id="role" name="role">
                                <option value="0" disabled selected>Pilih</option>
                                @foreach ($staffRole as $sr)
                                <option value="{{ $sr->id }}">{{ $sr->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Nomor Telp / WA</label>
                            <input @error("phone") style="border:1px solid #ff0000;" @enderror name="phone" type="number"
                                value="{{ old("phone") }}" class="form-control" id="phone" placeholder="phone">
                            @error("phone")
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input @error('email') style="border:1px solid #ff0000;" @enderror name="email" type="email"
                                value="{{ old('email') }}" class="form-control" id="email" placeholder="email">
                            @error('email')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea style="resize: none" @error('address') style="border:1px solid #ff0000;" @enderror
                        name="address" type="text" value="{{ old('address') }}" class="form-control" id="address"
                        placeholder="address"></textarea>
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