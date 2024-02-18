<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Tindakan Baru</h6>
    </div>
    <div class="card-body">
        <div class="mx-auto">
            <form method="POST" action="{{ route('tindakan-create') }}">
                @csrf
                <div class="form-group">
                    <label for="code">Kode Tindakan</label>
                    <div  class="form-control">{{ $actCode }}</div>
                    <input name="code" type="text" style="display: none" value="{{ $actCode }}">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama Tindakan</label>
                            <input @error('name') style="border:1px solid #ff0000;" @enderror name="name" type="text"
                                value="{{ old('name') }}" class="form-control" id="name" placeholder="name">
                            @error('name')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input @error('price') style="border:1px solid #ff0000;" @enderror name="price" type="number"
                                value="{{ old('price') }}" class="form-control" id="price" placeholder="price">
                            @error('price')
                            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
</div>