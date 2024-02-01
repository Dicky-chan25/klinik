@extends('landing-page.queue')

@section('landing-page-form-layout')
<div class="bg-header">
    @include('landing-page.navbar')
    <div class="container-general-header">
        <p class="general-title">Pendaftaran Pasien</p>
        {{-- <p class="general-subtitle">Jika Anda belum pernah mendaftar sebelumnya, Anda harus melakukan registrasi
            terlebih dahulu, klik tombol di bawah jika sudah pernah registrasi</p>
        <div class="new-patient-btn">
            <a href="/" class="btn-primary">Sudah Pernah Registrasi</a>
        </div> --}}
    </div>
</div>
<div class="card-history-container">
    <p class="card-regis-title">List Antrian Pasien</p>
    <br>
    <table>
        <tr>
            <th>
                <p class="header-table">No. Antrian</p>
            </th>
            <th>
                <p class="header-table">Nama Pasien</p>
            </th>
            <th>
                <p class="header-table">Layanan</p>
            </th>
            <th>
                <p class="header-table">Dokter</p>
            </th>
            <th>
                <p class="header-table">Status</p>
            </th>
        </tr>
        <tr>
            <td>
                <p class="value-table-queue">001</p>
            </td>
            <td>
                <p class="value-table">Lorem ipsum dolor sit amet consectetur</p>
            </td>
            <td>
                <p class="value-table">Poli Umum</p>
            </td>
            <td>
                <p class="value-table">adipisicing elit. Eos, autem!</p>
            </td>
            <td>
                <div class="status-table-proccess">
                    <div class="circle-proccess"></div>
                    <p class="status-value-table-proccess">Proses Diagnosa</p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <p class="value-table-queue">001</p>
            </td>
            <td>
                <p class="value-table">Lorem ipsum dolor sit amet consectetur</p>
            </td>
            <td>
                <p class="value-table">Poli Umum</p>
            </td>
            <td>
                <p class="value-table">adipisicing elit. Eos, autem!</p>
            </td>
            <td>
                <div class="status-table-wait">
                    <div class="circle-wait"></div>
                    <p class="status-value-table-wait">Menunggu Antrian</p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <p class="value-table-queue">001</p>
            </td>
            <td>
                <p class="value-table">Lorem ipsum dolor sit amet consectetur</p>
            </td>
            <td>
                <p class="value-table">Poli Umum</p>
            </td>
            <td>
                <p class="value-table">adipisicing elit. Eos, autem!</p>
            </td>
            <td>
                <div class="status-table-wait">
                    <div class="circle-wait"></div>
                    <p class="status-value-table-wait">Menunggu Antrian</p>
                </div>
            </td>
        </tr>
    </table>
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
                <a class="modal-btn-primary" href="{{ route('new-patient', ['step' => 0]) }}">Ya, Setuju</a>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Confirm Registration --}}
@endsection