@extends('landing-page.queue')

@section('landing-page-form-layout')
    <div class="bg-header">
        @include('landing-page.navbar')
        <div class="container-general-header">
            <p class="general-title">Pendaftaran Pasien</p>
            <p class="general-subtitle">Dengan mengisi formulir ini, Anda menyatakan bahwa akan melakukan pemeriksaan
                berdasarkan data inputan yang Anda masukkan</p>
        </div>
    </div>
    <form method="POST" action="{{ route('queue') }}">
        @csrf
        <div class="card-regis-container">
            <p class="card-regis-title">Registrasi Keluhan Pasien</p>
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
                    <label class="lp-label-form" for="identity">Nomor Induk Kependudukan (identity) / Nomor BPJS</label>
                    <input type="number" class="lp-input" name="identity" id="identity" value="{{ old('identity') }}"
                        @error('identity') style="border:1px solid #ff0000;" @enderror>
                    @error('identity')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="lp-form-row">
                <div class="lp-form-service">
                    <label class="lp-label-form" for="complain">Layanan</label>
                    <a href="#modal-list-service" class="btn-primary-sm">Pilih Layanan</a>
                    <input type="number" name="service" class="service_value">
                </div>
            </div>
            <div class="ls-data ls-item ls-data-choosed">
                <div class="ls-thumb">
                    <img class="ls-img"
                        src="https://www.shutterstock.com/image-photo/healthcare-medical-staff-concept-portrait-600nw-2281024823.jpg"
                        alt="doctor">
                </div>
                <div class="ls-title">
                    <p class="title ls-data-title"></p>
                    <p class="sub ls-data-doctor"></p>
                </div>
                <div class="ls-title-value">
                    <p class="title ls-data-schedule"></p>
                    <p class="title ls-data-time"></p>
                </div>
                <div class=""></div>
            </div>
            <div class="lp-form-row">
                <div class="lp-form">
                    <label class="lp-label-form" for="complain">Masukkan keluhan Anda</label>
                    <textarea name="complain" class="lp-input" rows="4" value="{{ old('complain') }}" style="resize: none"
                        @error('complain') style="border:1px solid #ff0000;" @enderror></textarea>
                    @error('complain')
                        <span style="color: #ff0000;font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="lp-form-btn">
                <div class=""></div>
                <div class="">
                    <a href="{{ route('new-patient', ['step' => 0]) }}" class="btn-secondary">Belum Pernah Registrasi</a>
                    <a href="#modal-confirm-regist" class="btn-primary">Buat Antrian Baru</a>
                </div>
            </div>
        </div>
        @include('landing-page.modal_confirm_registration')
        @include('landing-page.list-service')
    </form>

@endsection

@section('script')
    <script></script>
@endsection
