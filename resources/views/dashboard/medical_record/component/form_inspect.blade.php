<div class="card shadow mb-4">
   
    {{-- @livewire('dashboard.medical_record.component.dropdown_patient'); --}}
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Pemeriksaan Lanjutan</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('rekammedis-create-inspect', ['id' => $idMr]) }}">
                @csrf
                <input name="code" type="text" style="display: none" value="{{ $mCode }}">
                <livewire:dropdown-inspection />
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="info" class="form-control">
                </div>
                <br>
                <div class="justify-content-between d-flex">
                    <div class=""></div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
