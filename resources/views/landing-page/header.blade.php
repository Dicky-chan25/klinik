{{-- Header --}}
<div class="header-row">
    <div class="header-content">
        <p class="header-title">Where prime smiles</p>
        <p class="header-title2">meets prime Doctor</p>
        {{-- <p class="header-title">Where prime smiles meets prime Doctor</p> --}}
        <p class="header-subtitle">Klinik Sehat dibangun sejak tahun 2023 yang berada di kecamatan Pakuhaji Kabupaten Tangerang</p>
  
        <a href="#demo-modal" class="header-btn">Daftar Antrian Sekarang</a>
        {{-- <button class="header-btn" uk-toggle="target: #my-id" type="button">Daftar Antrian Sekarang</button> --}}
    </div>
    <div class="header-img">
        <img class="header-section" src="{{asset('img/header-img.png')}}" alt="header-img">
    </div>
</div>
{{-- End Header --}}


<div id="demo-modal" class="modal">
    <div class="modal__content">
        <a href="#" class="modal__close">
            <div class="close-container">
                <img class="modal-btn-close" src="{{asset('img/cross.png')}}" alt="close">
            </div>
        </a>
        <div class="modal-body">
            <p class="modal-title">Sudah Pernah Registrasi ?</p>
            <p class="modal-subtitle">Apakah Anda pernah registrasi ( Pasien Lama ) ? </p>
            <div class="modal-btn-bottom">
                <a class="modal-btn-primary" href="{{route('queue')}}">Ya, Sudah</a>
                <a class="modal-btn-secondary" href="{{route('new-patient', ['step' => 0])}}">Belum Pernah</a>
            </div>
        </div>
    </div>
</div>