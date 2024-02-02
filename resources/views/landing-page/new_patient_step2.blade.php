<div class="card-regis-container step2">
    <p class="card-regis-title">Langkah 2 - Registrasi Keluhan Pasien</p>
    <br>

    <input type="number" name="service" class="service_value">

    <div class="lp-form-row">
        <div class="lp-form-service">
            <label class="lp-label-form" for="complain">Layanan</label>
            <a href="#modal-list-service" class="btn-primary-sm">Pilih Layanan</a>

        </div>
    </div>
    <div class="ls-data ls-item ls-data-choosed" >
        <div class="ls-thumb">
            <img class="ls-img" src="https://www.shutterstock.com/image-photo/healthcare-medical-staff-concept-portrait-600nw-2281024823.jpg" alt="doctor">
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
            <a id="prev" class="btn-secondary">Kembali</a>
            <a href="#modal-confirm-regist" class="btn-primary">Buat Antrian Baru</a>
        </div>
    </div>
</div>