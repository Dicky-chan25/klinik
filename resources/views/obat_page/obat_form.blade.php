@extends('layout.main')
<title>Dashboard Obat</title>
@section('container')

    {{-- @if ($errors->any())
        @foreach ($errors->all() as $item)
            <div class="alert alert-danger" role="alert">
                {{ $item }}
            </div>
        @endforeach

    @endif --}}
    <div class="container">
        <h1>Obat Baru</h1>
        <br>
        <form action="/obat_page/total_stok" method="post" enctype="multipart/form-data">
            @csrf

        </--------------------------------------------------------Kode Obat-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Obat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="kodeobat" placeholder="Kode obat.."
                        value="{{ old('kodeobat') }}">
                </div>
            </div>
            </--------------------------------------------------------Nama-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Obat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="namaobat" placeholder="Nama obat.." 
                        value="{{ old('namaobat') }}">
                </div>
            </div>
            
        </--------------------------------------------------------tanggal expired-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Expired</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control @error('expired') is-invalid @enderror" name="expired"
                        placeholder="Tanggal Expired" value="{{ old('expired') }}">
                    @error('expired')
                        <div class="invalid-feedback">
                            "tanggal expired masih kosong
                        </div>
                    @enderror
                </div>
            </div>

        </--------------------------------------------------------Dosis-----------------------------------------------------------------------------------* />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dosis</label>
                <div class="col-sm-5">
                    <input type="text" name="dosis" class="form-control"placeholder="Dosis..." value="{{ old('dosis') }}">
                    @error('dosis')
                        <div class="invalid-feedback">
                            "dosis masih kosong
                        </div>
                    @enderror
                </div>
            </div>

        </--------------------------------------------------------Jenis-----------------------------------------------------------------------------------* />
        <div class="form-group row">
            <label class="col-form-label col-sm-2 pt-0">Jenis Obat</label>
            <div class="col-sm-5">
                <select name="jenis" value="{{ old('jenis') }}" class="form-control @error('Jenis') is-invalid @enderror">
                    <option selected value="">Pilih jenis...</option>
                    @foreach($jenis as $j)
                    <option value="{{ $j->id }}">{{ $j->jenisobat }}</option>
                    @endforeach
                </select>
                @error('Jenis')
                <div class="invalid-feedback">
                    "pilih jenis obat
                </div>
                @enderror
            </div>
        </div>

        </--------------------------------------------------------Stok-----------------------------------------------------------------------------------* />
        
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Stok Obat</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok"
                        name="stok" placeholder="Masukkan Jumlah Awal..." value="{{ old('stok') }}" >
                        @error('stok')
                        <div class="invalid-feedback">
                            "stok obat masih kosong
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Harga Obat</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                        name="harga" placeholder="Harga obat.." value="{{ old('harga') }}">
                    @error('harga')
                        <div class="invalid-feedback">
                            "harga obat masih kosong
                        </div>
                    @enderror
                </div>
            </div>
        </--------------------------------------------------------Photo-----------------------------------------------------------------------------------* />
           

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Obat</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                name="image"  onchange="previewImage()">
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div> 

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="/obat-total-stok" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </form>
    </div>
    </div>

    
    @endsection
    <script>
        function previewImage()
{
  const image = document.querySelector('#image');
  const imgPreview = document.querySelector('.img-preview');

  imgPreview.style.display = 'block';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent)
  {
    imgPreview.src = oFREvent.target.result;
  }

}
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

