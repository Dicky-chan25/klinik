@extends('landing-page.queue')

@section('landing-page-form-layout')
    <div class="bg-header">
        @include('landing-page.navbar')
        <div class="container-general-header">
            <p class="general-title">Pendaftaran Pasien</p>
            <p class="general-subtitle">Antrian Anda akan di tampilkan disini, batas maksimal antrian per harinya adalah 30
                antrian</p>
        </div>
    </div>
    <div class="card-history-container">
        <p class="card-regis-title">List Antrian Pasien</p>
        <br>
        <table>
            <thead>
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
            </thead>
            <tbody>
                @foreach ($listQueue as $lq)
                    <tr>
                        <td>
                            <p class="value-table-queue">{{ sprintf('%03d', $lq->queue) }}</p>
                        </td>
                        <td>
                            <p class="value-table">{{ $lq->patientName }}</p>
                        </td>
                        <td>
                            <p class="value-table">{{ $lq->poliName }}-{{ $lq->serviceName }}</p>
                        </td>
                        <td>
                            <p class="value-table">{{ $lq->doctorName }}</p>
                        </td>
                        <td>
                            @if ($lq->status == 0)
                                <div class="status-table-wait">
                                    <div class="circle-wait"></div>
                                    <p class="status-value-table-wait">Menunggu</p>
                                </div>
                            @endif
                            @if ($lq->status == 1)
                                <div class="status-table-proccess">
                                    <div class="circle-proccess"></div>
                                    <p class="status-value-table-proccess">Proses</p>
                                </div>
                            @endif
                            @if ($lq->status == 2)
                                <div class="status-table-done">
                                    <div class="circle-done"></div>
                                    <p class="status-value-table-done">Selesai</p>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
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
