<title>Antrian : {{ $rekam->pasien->nama }}</title>
@extends('layout.main')

@section('container')

    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <div class="alert alert-danger" role="alert">
                {{ $item }}
            </div>
        @endforeach

    @endif
    <div class="card">
        <div class="card-header mt-3">
        <h3>Edit Antrian Pasien</h3>
        </div>
        <div class="card-body mb-5">
        <form action="/rekam/update/{{ $rekam->id }}" method="POST">
            @csrf
        </--------------------------------------------------------kodepasien-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Pasien</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Kodepasien" value="{{ $rekam->pasien->kodepasien }}"
                        readonly>
                </div>
            </div>

            </--------------------------------------------------------Nama-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Atas Nama</label>
                <div class="col-sm-5">
                    <input class="form-control" value="{{ $rekam->pasien->nama }}" readonly>
                    
                </div>
            </div>

            </--------------------------------------------------------Lahir-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lahir</label>
                <div class="col-sm-5">
                    <input class="form-control" value="{{ date("d/m/Y", strtotime($rekam->pasien->lahir)); }}" readonly>
                        
                    
                </div>
            </div>

            <h4>==== Perubahan Data Pendaftaran ====</h4>
            <br>
            <!--------------------------------------------------------Layanan----------------------------------------------------------------------------------- -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis layanan</label>
                <div class="col-sm-5">
                    <select name="layanan" id="">
                        @if($rekam->layanan == 'Umum')
                            <option value="-">Pilih layanan..</option>
                            <option value="Umum" selected>{{ $rekam->layanan }}</option>
                            <option value="Asuransi">{{ 'Asuransi' }}</option>
                        @elseif($rekam->layanan == 'Asuransi')
                            <option value="-">Pilih layanan..</option>
                            <option value="Umum">{{ 'Umum' }}</option>
                            <option value="Asuransi" selected>{{ $rekam->layanan }}</option>
                        @else
                            <option value="-">Pilih layanan..</option>
                            <option value="Umum">{{ 'Umum' }}</option>
                            <option value="Asuransi">{{ 'Asuransi' }}</option>
                        @endif
                    </select>
                </div>
            </div>

            <!--------------------------------------------------------keluhan pasien----------------------------------------------------------------------------------- -->
            <div class="form-group row mt-2">
                <label class="col-sm-2 col-form-label">Keluhan</label>
                <div class="col-sm-5">
                    <textarea type="text" name="keluhan" class="form-control" cols="30" rows="5"
                        placeholder="Jelaskan sakit anda, dan sudah berapa lama?">{{ $rekam->keluhan }}</textarea>
                </div>
            </div>

            <!--------------------------------------------------------dokter pemriksa----------------------------------------------------------------------------------- -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dokter</label>
                <div class="col-sm-5">
                    <select name="dokter" id="">
                        <option value="">Pilih dokter</option>
                        @foreach($dokter as $row)
                        <option value="{{ $row->id }}" {{ $rekam->dokter != '' ?? $row->dokter->id == $row->id ? 'selected' : ''}}> {{ $row->nama .' |'}} {{ $row->jadwal == '' ? 'Belum ada Jadwal' : $row->jadwal->jadwalpraktek }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/rekam/antrian-pasien-admin" class="btn btn-warning">Kembali</a>
            </div>
        </div>
        </form>
    </div>
    </div>
@endsection
    <script>
        function setInputFilter(textbox, inputFilter, errMsg) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(
                function(event) {
                    textbox.addEventListener(event, function(e) {
                        if (inputFilter(this.value)) {
                            // Accepted value
                            if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                                this.classList.remove("input-error");
                                this.setCustomValidity("");
                            }
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                            // Rejected value - restore the previous one
                            this.classList.add("input-error");
                            this.setCustomValidity(errMsg);
                            this.reportValidity();
                            this.value = this.oldValue;
                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        } else {
                            // Rejected value - nothing to restore
                            this.value = "";
                        }
                    });
                });
        }

        setInputFilter(document.getElementById("nonik"), function(value) {
            return /^-?\d*$/.test(value);
        }, "Isi dengan Angka");
        setInputFilter(document.getElementById("notelp"), function(value) {
            return /^-?\d*$/.test(value);
        }, "Isi dengan Angka");
    </script>

