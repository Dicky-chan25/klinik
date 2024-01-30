@extends('landing-page.queue')

@section('landing-page-form-layout')
    <div class="bg-header">
        @include('landing-page.navbar')
        <div class="container-queue">
            <p class="general-title">Pendaftaran Pasien</p>
            <p class="general-subtitle">Jika Anda belum pernah mendaftar sebelumnya, Anda harus melakukan registrasi
                terlebih dahulu, klik tombol di bawah jika sudah pernah registrasi</p>
            <div class="new-patient-btn">
                <a href="{{ route('queue') }}" class="btn-primary">Sudah Pernah Registrasi</a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('new-patient') }}">
        @csrf
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
                    <label class="lp-label-form" for="nik">Nomor Induk Kependudukan (NIK)</label>
                    <input type="number" class="lp-input" name="nik" id="nik" value="{{ old('nik') }}"
                        @error('nik')
                    style="border:1px solid #ff0000;" @enderror>
                    @error('nik')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="lp-form-row">
                <div class="lp-form">
                    <label class="lp-label-form" for="bpjs">Nomor BPJS Kesehatan (opsional)</label>
                    <input type="text" class="lp-input" name="bpjs" id="bpjs" value="{{ old('bpjs') }}"
                        @error('bpjs') style="border:1px solid #ff0000;" @enderror>
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
                        <option value="0">Pilih</option>
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
                        <option value="0">Pilih</option>
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
                        <option value="0">Pilih</option>
                        @foreach ($education as $edu)
                            <option value="{{$edu->id}}">{{$edu->title}}</option>
                        @endforeach
                        <option value="1">Di Bawah SD</option>
                    </select>
                    @error('doctor')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="lp-form-row">
                <div class="lp-form">
                    <label class="lp-label-form" for="wa">Nomor Telp / WA</label>
                    <input type="number" class="lp-input" name="wa" id="wa" value="{{ old('wa') }}"
                        @error('wa')
                    style="border:1px solid #ff0000;" @enderror>
                    @error('wa')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lp-form">
                    <label class="lp-label-form" for="email">Email (opsional)</label>
                    <input type="email" class="lp-input" name="email" id="email" value="{{ old('email') }}"
                        @error('email')
                    style="border:1px solid #ff0000;" @enderror>
                    @error('email')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="lp-form-row">
                <div class="lp-form">
                    <label class="lp-label-form" for="address">Alamat lengkap sesuai KTP</label>
                    <textarea class="lp-input" rows="4" value="{{ old('address') }}" style="resize: none"
                        @error('address')
                    style="border:1px solid #ff0000;" @enderror></textarea>
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

        <div class="card-regis-container step2">
            <p class="card-regis-title">Langkah 2 - Registrasi Keluhan Pasien</p>
            <br>
            <div class="lp-form-row">
                <div class="lp-form">
                    <label class="lp-label-form" for="services">Pilih Layanan</label>
                    <select id="services" class="lp-input" @error('poli') style="border:1px solid red;" @enderror
                        id="poli" name="poli">
                        <option value="0">Pilih</option>
                        <option value="0">Poli Umum</option>
                        <option value="0">Poli Klinik</option>
                        <option value="0">Poli THT</option>
                    </select>
                    @error('poli')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lp-form">
                    <label class="lp-label-form" for="doctor">Pilih Dokter</label>
                    <select id="services" class="lp-input" @error('doctor') style="border:1px solid red;" @enderror
                        id="doctor" name="doctor">
                        <option value="0">Pilih</option>
                        <option value="0">Dr. Asep</option>
                        <option value="0">Dr. Test</option>
                    </select>
                    @error('doctor')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="lp-form-row">
                <div class="lp-form">
                    <label class="lp-label-form" for="complain">Masukkan keluhan Anda</label>
                    <textarea class="lp-input" rows="4" value="{{ old('complain') }}" style="resize: none"
                        @error('complain') style="border:1px solid #ff0000;" @enderror></textarea>
                    @error('complain')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="lp-form-btn">
                <div class=""></div>
                <div class="">
                    <a id="prev" class="btn-secondary">Kembali</a>
                    <a href="#modal-confirm-regist" class="btn-primary">Buat Antrian Baru</a>
                </div>
            </div>
        </div>

        {{-- Modal Confirm Registration --}}
        <div id="modal-confirm-regist" class="modal">
            <div class="modal__content">
                <a href="#" class="modal__close">
                    <div class="close-container">
                        <img class="modal-btn-close" src="{{ asset('img/cross.png') }}" alt="close">
                    </div>
                </a>
                <div class="modal-body">
                    <p class="modal-title">Apakah Anda Yakin ?</p>
                    <p class="modal-subtitle">Dengan ini maka Anda setuju untuk dibuatkan list Antrian</p>
                    <div class="modal-btn-bottom">
                        <a class="modal-btn-secondary" href="#">Kembali</a>
                        <button class="modal-btn-primary" type="submit">Ya, Setuju</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Confirm Registration --}}
    </form>
@endsection
@section('script')
    <script>
        $(".step1").show();
        $(".step2").hide();
        $("#next").click(function() {
            $(".step1").hide();
            $(".step2").show();
        });
        $("#prev").click(function() {
            $(".step1").show();
            $(".step2").hide();
        });
    </script>
@endsection
