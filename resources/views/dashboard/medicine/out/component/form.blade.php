<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat User Baru</h6>
    </div>
    <div class="card-body">

        <form method="POST" action="{{route('userlevels-create')}}">
            @csrf
            <div class="form-group">
                <label for="levelname">Level Name</label>
                <input @error('levelname') style="border:1px solid #ff0000;" @enderror name="levelname" type="text"
                    value="{{ old('levelname') }}" class="form-control" id="levelname" placeholder="levelname">
                @error('levelname')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" id="status" type="checkbox" name="status">
                <label class="form-check-label" for="status">Aktifkan Sekarang</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit Data</button>
        </form>
    </div>
</div>