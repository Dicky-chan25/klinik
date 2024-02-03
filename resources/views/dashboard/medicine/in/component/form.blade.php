<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat User Baru</h6>
    </div>
    <div class="card-body">

        <form method="POST" action="{{route('menus-create', ['id' => 0])}}">
            @csrf
            <div class="form-group">
                <label for="menuname">Nama Menu</label>
                <input @error('menuname') style="border:1px solid #ff0000;" @enderror name="menuname" type="text"
                    value="{{ old('menuname') }}" class="form-control" id="menuname" placeholder="menuname">
                @error('menuname')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check my-2">
                <input class="form-check-input parent-onclick" id="isparent" type="checkbox" name="isparent">
                <label class="form-check-label" for="isparent">Memiliki Parent</label>
            </div>
            <div class="form-check my-2 parent">
                <input class="form-check-input" id="independent" type="checkbox" name="independent">
                <label class="form-check-label" for="independent">Memiliki Sub</label>
            </div>
            <div class="form-group children">
                <label for="parentmenu">Pilih Parent Menu</label>
                <select class="form-control" id="parentmenu" name="parentmenu">
                    <option selected disabled>Choose</option>
                    @foreach ($parentMenu as $pm)
                    <option value="{{$pm->id}}">{{$pm->menuname}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check my-2">
                <input class="form-check-input" id="status" type="checkbox" name="status">
                <label class="form-check-label" for="status">Aktifkan Sekarang</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit Data</button>
        </form>
    </div>
</div>

