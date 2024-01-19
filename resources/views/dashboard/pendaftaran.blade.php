<title>Daftarkan Pasien</title>
@extends('layout.main')

@section('container')


        @if (session()->has('failed'))
            <div class="alert alert-danger mb-3" role="alert">
                {{ session('failed') }}
            </div>
        @elseif (session()->has('addsuccess'))
            <div class="alert alert-success" role="alert">
                {{ session('addsuccess') }}
            </div>
        @endif
        
<div class="card">
    <div class="card-header mt-3">
        <h3>Daftar Harian Pasien</h3>
    </div> 
        <div class="card-body mb-5">
            <a href="/tambahpasienadmin" type="button" class="btn btn-success mb-2">
            <i class="fas fa-plus text-white"></i> <i class="fas fa-address-book text-white"></i>  Tambah Pasien Baru</a></a>

    <!--------------------------------------------------------Bagian Isi Konten----------------------------------------------------------------------------------->
    <section class="page-section portfolio" id="lama">
        <div class="container">

            <form action="/cekpasienlamaadmin" method="POST">
                @csrf
                <!--------------------------------------------------------Nama----------------------------------------------------------------------------------->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="Nama" placeholder="Nama Lengkap"
                            required="required" oninvalid="this.setCustomValidity('Nama tidak boleh kosong')"
                            oninput="setCustomValidity('')">
                    </div>
                </div>
                </--------------------------------------------------------Lahir-----------------------------------------------------------------------------------* />
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lahir</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control @error('Lahir') is-invalid @enderror" name="Lahir"
                            placeholder="Lahir">
                        @error('Lahir')
                            <div class="invalid-feedback">
                                "tanggal lahir masih kosong
                            </div>
                        @enderror
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-warning col-sm-2">
                    <i class="fas fa-search"></i> Cari</button>
        </div>
        </form>
    </section>


    <!--------------------------------------------------------modal kartu pasien----------------------------------------------------------------------------------->

    <div class="modal fade" id="pasienlamas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="antrianLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="kartuantrian">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="staticBackdropLabel">
                            <img src="{{ asset('') }}assets/img/icon.png" style=”float:left;
                                width="55";height="55" />Klinik Sehat
                        </h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="h3">Data Pasien Ditemukan</p>
                        <p>Nama : <span class="text-primary">{{ Session::get('nama') }}</span>
                        </p>
                        <p>Alamat : <span class="text-primary">{{ Session::get('alamat') }}</span>
                        </p>
                        <p>Tanggal Lahir : <span class="text-primary">{{ Session::get('lahir') }}</span>
                        </p>
                        <p>Kelamin : <span class="text-primary">{{ Session::get('kelamin') }}</span>
                        </p>

                        <form action="/addrekamadmin" method="POST">
                            @csrf
                            <div class="form-group row mt-2">
                                <input type="text" value="{{ Session::get('id') }}" name="id_player" readonly
                                    hidden>
                            </div>
                            <div class="form-group row mt-2">
                                <label class="col-form-label col-sm-2 pt-0">Layanan</label>
                                <div class="col-sm">
                                    <select name="layanan" class="form-control " required
                                        oninvalid="this.setCustomValidity('Pribadi / Asuransi?')"
                                        oninput="setCustomValidity('')">
                                        <option value="">pilih layanan...</option>
                                        <option value="Umum">Umum</option>
                                        <option value="Asuransi">Asuransi</option>
                                    </select>
                                </div>
                            </div>
                            <!--------------------------------------------------------rekam medis----------------------------------------------------------------------------------- -->
                            <div class="form-group row mt-2">
                                <label class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm">
                                    <textarea type="text" name="keluhan" class="form-control" cols="30" rows="5"
                                        placeholder="Jelaskan keluhan anda, dan sudah berapa lama?" required
                                        oninvalid="this.setCustomValidity('jelaskan keluhan anda...')" oninput="setCustomValidity('')"></textarea>
                                </div>
                            </div>

                            <!--------------------------------------------------------pilih dokter----------------------------------------------------------------------------------- -->
                            <div class="form-group row mt-2">
                                <label class="col-form-label col-sm-2 pt-0">Dokter</label>
                                <div class="col-sm">
                                    <select name="dokter" class="form-control " required
                                        oninvalid="this.setCustomValidity('pilih dokter yang tersedia...')"
                                        oninput="setCustomValidity('')">
                                        <option value="">pilih dokter...</option>
                                        @foreach ($dokter as $row)
                                            <option value="{{ $row->id }}">
                                                {{ $row->nama }}({{ $row->poli == '' ? '-' : $row->poli->name }}) |
                                                {{ $row->jadwal == '' ? 'Belum ada Jadwal' : $row->jadwal->jadwalpraktek }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="mt-2 d-flex justify-content-center">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div> --}}

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--------------------------------------------------------modal kartu antrian----------------------------------------------------------------------------------->
<div class="modal fade" id="antrian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="antrianLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div id="kartuantrian2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <img src="{{ asset('') }}assets/img/icon.png" style=”float:left;
                            width="55";height="55" />Klinik Sehat
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="h3">Nomor Antrian : <span
                            class="text-primary">{{ Session::has('nomorAntrian') ? Session::get('nomorAntrian') : '' }}</span>
                    </p>
                    <p class="h3">Atas Nama : <span
                            class="text-primary">{{ Session::has('nama') ? Session::get('nama') : '' }}</span>
                    </p>
                    <p>Daftar pada jam : <span
                            class="text-primary">{{ Session::has('timestamps') ? Session::get('timestamps') : '' }}</span>
                    </p>
                </div>
                <div class="modal-footer">
                    <p>Tanggal : <span
                            class="text-primary">{{ Session::has('tanggaldaftar') ? Session::get('tanggaldaftar') : '' }}</span>
                    </p>

                    <a type="button" class="btn btn-secondary" href="/rekam/antrian-pasien-admin">
                        <i class="fas fa-users me-2"></i>
                        Cek Antrian
                    </a>
                    <button type="button" class="btn btn-primary" id="download">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------------------------------------------------------modal error----------------------------------------------------------------------------------->
<div class="modal fade" id="error" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="antrianLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="kartuantrian">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <img src="{{ asset('') }}assets/img/icon.png" style=”float:left;
                            width="55";height="55" />Klinik {{ env('APP_NAME') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-danger" role="alert">
                            {{ $item }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    <!--------------------------------------------------------Bootstrap JS----------------------------------------------------------------------------------->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--------------------------------------------------------modal antrian----------------------------------------------------------------------------------->
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#error').modal('show')
            });
        </script>
    @endif

    <script>
        @if (Session::has('success'))
            $(document).ready(function() {
                $('#pasienlamas').modal('show')
            });
        @elseif (Session::has('failed'))
            $(document).ready(function() {
                $('#pasienlamaf').modal('show')
            });
        @elseif (Session::has('addsuccess'))
            $(document).ready(function() {
                $('#antrian').modal('show')
            });
        @endif
    </script>

    <!--------------------------------------------------------modal antrian----------------------------------------------------------------------------------->
    <script>
        @if (Session::has('nomorAntrian'))
            $(document).ready(function() {
                $('#antrian').modal('show')
            });
        @endif
    </script>
    <!--------------------------------------------------------fungsi inputan angka/number only----------------------------------------------------------------------------------->
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

    <!--------------------------------------------------------fungsi jam----------------------------------------------------------------------------------->
    <script type="text/javascript">
        function updateClock() {
            var now = new Date();
            var dname = now.getDay(),
                mo = now.getMonth(),
                dnum = now.getDate(),
                yr = now.getFullYear(),
                hou = now.getHours(),
                min = now.getMinutes(),
                sec = now.getSeconds(),
                pe = "AM";

            if (hou >= 12) {
                pe = "PM";
            }
            if (hou == 0) {
                hou = 12;
            }
            if (hou > 12) {
                hou = hou - 12;
            }

            Number.prototype.pad = function(digits) {
                for (var n = this.toString(); n.length < digits; n = 0 + n);
                return n;
            }

            var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
            var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
            for (var i = 0; i < ids.length; i++)
                document.getElementById(ids[i]).firstChild.nodeValue = values[i];
        }

        function initClock() {
            updateClock();
            window.setInterval("updateClock()", 1);
        }
    </script>

    <!--------------------------------------------------------fungsi download kartu antrian----------------------------------------------------------------------------------->
    <script>
        document.getElementById("download").addEventListener("click", function() {
            const imgName = prompt("Input nama gambar yang akan diunduh: ")
            html2canvas(document.querySelector('#kartuantrian2')).then(function(canvas) {

                console.log(canvas);
                saveAs(canvas.toDataURL(), imgName + '.jpg');
            });
        });

        function saveAs(uri, filename) {
            var link = document.createElement('a');
            if (typeof link.download === 'string') {
                link.href = uri;
                link.download = filename;
                //Firefox requires the link to be in the body
                document.body.appendChild(link);
                //simulate click
                link.click();
                //remove the link when done
                document.body.removeChild(link);
            } else {
                window.open(uri);
            }
        }
    </script>
@endsection
