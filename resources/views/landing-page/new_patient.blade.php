@extends('landing-page.queue')

@section('landing-page-form-layout')
    <div class="bg-header">
        @include('landing-page.navbar')
        <div class="container-general-header">
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
        @include('landing-page.new_patient_step1')
        @include('landing-page.new_patient_step2')
        @include('landing-page.modal_confirm_registration')
        @include('landing-page.list-service')
    </form>
@endsection
@section('script')
    <script>
        // handle klink next and previous
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
