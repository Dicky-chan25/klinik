<div class="card-regis-container step1">
    <p class="card-regis-title">Langkah 1 - Registrasi Pasien Baru</p>
    <br>
    @if (Session::has('error'))
    <label>
        <input type="checkbox" class="alertCheckbox" autocomplete="off" />
        <div class="alert error">
            <span class="alertClose">X</span>
            <span class="alertText">{{ Session::get('error') }}
                <br class="clear" /></span>
        </div>
    </label>
    @endif
    @foreach ($errors->all() as $error)
    <label>
        <input type="checkbox" class="alertCheckbox" autocomplete="off" />
        <div class="alert error">
            <span class="alertClose">X</span>
            <span class="alertText">{{ $error }}
                <br class="clear" /></span>
        </div>
    </label>
    @endforeach
    {{-- Alert --}}
    <div class="lp-form-row">
        <div class="lp-form">
            <label class="lp-label-form" for="fullname">Nama Lengkap sesuai KTP</label>
            <input type="text" class="lp-input" name="fullname" id="fullname" value="{{ old('fullname') }}"
                @error('fullname') style="border:1px solid #ff0000;" @enderror>
            @error('fullname')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="lp-form">
            <label class="lp-label-form" for="identity">Nomor Induk Kependudukan (identity)</label>
            <input type="number" class="lp-input" name="identity" id="identity" value="{{ old('identity') }}"
                @error('identity') style="border:1px solid #ff0000;" @enderror>
            @error('identity')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="lp-form-row">
        <div class="lp-form">
            <label class="lp-label-form" for="bpjs">Nomor BPJS Kesehatan (opsional)</label>
            <input type="text" class="lp-input" name="bpjs" id="bpjs" value="{{ old('bpjs') }}" @error('bpjs')
                style="border:1px solid #ff0000;" @enderror>
            @error('bpjs')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="lp-form">
            <label class="lp-label-form" for="gender">Jenis Kelamin</label>
            <select id="gender" class="lp-input" @error('gender') style="border:1px solid red;" @enderror
                id="gender" name="gender">
                <option value="0" selected disabled>Pilih</option>
                <option value="1">Pria</option>
                <option value="2">Wanita</option>
            </select>
            @error('gender')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="lp-form-row">
        <div class="lp-form">
            <label class="lp-label-form" for="birthplace">Tempat Lahir</label>
            <input type="text" class="lp-input" name="birthplace" id="birthplace" value="{{ old('birthplace') }}"
                @error('birthplace') style="border:1px solid #ff0000;" @enderror>
            @error('birthplace')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="lp-form">
            <label class="lp-label-form" for="birthdate">Tanggal Lahir</label>
            <input type="date" class="lp-input" name="birthdate" id="birthdate" value="{{ old('birthdate') }}"
                @error('birthdate') style="border:1px solid #ff0000;" @enderror>
            @error('birthdate')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="lp-form">
            <label class="lp-label-form" for="religion">Agama</label>
            <select id="religion" class="lp-input" @error('religion') style="border:1px solid red;" @enderror
                id="religion" name="religion">
                <option value="0" disabled selected>Pilih</option>
                @foreach ($religion as $reli)
                <option value="{{$reli->id}}">{{$reli->title}}</option>
                @endforeach
            </select>
            @error('religion')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="lp-form-row">
        <div class="lp-form">
            <label class="lp-label-form" for="career">Pekerjaan</label>
            <select id="career" class="lp-input" @error('career') style="border:1px solid red;" @enderror
                id="career" name="career">
                <option value="0" disabled selected>Pilih</option>
                @foreach ($career as $car)
                <option value="{{$car->id}}">{{$car->title}}</option>
                @endforeach
            </select>
            @error('career')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="lp-form">
            <label class="lp-label-form" for="education">Status Pendidikan</label>
            <select id="education" class="lp-input" @error('education') style="border:1px solid red;" @enderror
                id="education" name="education">
                <option value="0" disabled selected>Pilih</option>
                @foreach ($education as $edu)
                <option value="{{$edu->id}}">{{$edu->title}}</option>
                @endforeach
            </select>
            @error('doctor')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="lp-form-row">
        <div class="lp-form">
            <label class="lp-label-form" for="wa">Nomor Telp / WA</label>
            <input type="number" class="lp-input" name="wa" id="wa" value="{{ old('wa') }}" @error('wa')
                style="border:1px solid #ff0000;" @enderror>
            @error('wa')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
        <div class="lp-form">
            <label class="lp-label-form" for="email">Email (opsional)</label>
            <input type="email" class="lp-input" name="email" id="email" value="{{ old('email') }}" @error('email')
                style="border:1px solid #ff0000;" @enderror>
            @error('email')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="lp-form-row">
        <div class="lp-form">
            <label class="lp-label-form" for="address">Alamat lengkap sesuai KTP</label>
            <textarea name="address" class="lp-input" rows="4" value="{{ old('address') }}" style="resize: none"
                @error('address') style="border:1px solid #ff0000;" @enderror></textarea>
            @error('address')
            <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="lp-form-btn">
        <div class=""></div>
        <div class="">
            <a href="/" class="btn-secondary">Kembali ke Home</a>
            <a id="next" class="btn-primary">Selanjutnya</a>
        </div>
    </div>
</div>