@extends('landing-page.queue')

@section('landing-page-form-layout')
    <div class="bg-header">
        @include('landing-page.navbar')
        <div class="container-queue">
            <p class="general-title">Pendaftaran Pasien</p>
            <p class="general-subtitle">Dengan mengisi formulir ini, Anda menyatakan bahwa akan melakukan pemeriksaan berdasarkan data inputan yang Anda masukkan</p>
        </div>
    </div>
    <div class="card-regis-container">
        <p class="card-regis-title">Registrasi Keluhan Pasien</p>
        <br>
        <div class="lp-form-row">
            <div class="lp-form">
                <label class="lp-label-form" for="">Nomor Telp / WA</label>
                <input type="number" class="lp-input">
            </div>
            <div class="lp-form">
                <label class="lp-label-form" for="">Nomor Induk Kependudukan (NIK)</label>
                <input type="number" class="lp-input">
            </div>
        </div>
        <div class="lp-form-row">
            <div class="lp-form">
                <label class="lp-label-form" for="">Pilih Layanan</label>
                <select id="services" class="lp-input">
                    <option>Pilih</option>
                    <option>Poli Umum</option>
                    <option>Poli Klinik</option>
                </select>
            </div>
            <div class="lp-form">
                <label class="lp-label-form" for="">Pilih Dokter</label>
                <select id="services" class="lp-input">
                    <option>Pilih</option>
                    <option>Dr. Asep</option>
                    <option>Dr. Test</option>
                </select>
            </div>
        </div>
        <div class="lp-form-row">
            <div class="lp-form">
                <label class="lp-label-form" for="">Masukkan keluhan Anda</label>
                <textarea class="lp-input" rows="4" style="resize: none"></textarea>
            </div>
        </div>
        <div class="lp-form-btn">
            <div class=""></div>
            <div class="">
                <a href="{{route('new-patient',['step' => 0])}}" class="btn-secondary">Belum Pernah Registrasi</a>
                <a href="#modal-confirm-queue" class="btn-primary">Buat Antrian Baru</a>
            </div>
        </div>
    </div>

    {{-- Modal Confirm Registration --}}
    <div id="modal-confirm-queue" class="modal">
        <div class="modal__content">
            <a href="#" class="modal__close">
                <div class="close-container">
                    <img class="modal-btn-close" src="{{asset('img/cross.png')}}" alt="close">
                </div>
            </a>
            <div class="modal-body">
                <p class="modal-title">Apakah Anda Yakin ?</p>
                <p class="modal-subtitle">Dengan ini maka Anda setuju untuk dibuatkan list Antrian</p>
                <div class="modal-btn-bottom">
                    <a class="modal-btn-secondary" href="#">Kembali</a>
                    <a class="modal-btn-primary" href="{{route('new-patient', ['step' => 0])}}">Ya, Setuju</a>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Confirm Registration --}}

@endsection

