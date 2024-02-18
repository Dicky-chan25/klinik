<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Pasien</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6 mx-auto">
            <form method="POST" action="{{ route('tindakan-edit-submit', ['id' => $dataDetail->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Tindakan</label>
                    <input @error('name') style="border:1px solid #ff0000;" @enderror name="name" type="text"
                        value="{{ $dataDetail->title }}" class="form-control" id="name" placeholder="name">
                    @error('name')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input @error('price') style="border:1px solid #ff0000;" @enderror name="price" type="number"
                        value="{{ $dataDetail->price }}" class="form-control" id="price" placeholder="price">
                    @error('price')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check my-2">
                    <input @if ($dataDetail->status == 1) checked @endif class="form-check-input" id="status" type="checkbox" name="status">
                    <label class="form-check-label" for="status">Data Aktif</label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>
