<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Dokter</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('dokter-edit-submit', ['id'=> $dataDetail->id]) }}" enctype="multipart/form-data">
                @csrf
                <div style="row">
                    <img style="width: 100px;height:100px;object-fit: contain" class="img-thumbnail rounded-circle mb-2"
                        src="{{ asset('img/doctor/' . $dataDetail->photo) }}" alt="{{ $dataDetail->photo }}">
                        <div class="form-group">
                            <input type="file" name="pic" id="pic" class="form-control">
                        </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="str">STR (Surat Tanda Registrasi)</label>
                            <input @error('str') style="border:1px solid #ff0000;" @enderror name="str" type="number"
                                value="{{ $dataDetail->str }}" class="form-control" id="str" placeholder="str">
                            @error('str')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sip">SIP (Surat Izin Praktek)</label>
                            <input @error('sip') style="border:1px solid #ff0000;" @enderror name="sip" type="number"
                                value="{{ $dataDetail->sip }}" class="form-control" id="sip" placeholder="sip">
                            @error('sip')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Komisi Dokter</label>
                    <input @error('price') style="border:1px solid #ff0000;" @enderror name="price" type="number"
                        value="{{ $dataDetail->price }}" class="form-control" id="price" placeholder="price">
                    @error('price')
                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="status" type="checkbox" name="status" @if ($dataDetail->status == 1) checked
                        
                    @endif>
                    <label class="form-check-label" for="status">Aktifasi Dokter</label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>
