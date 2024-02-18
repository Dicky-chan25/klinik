<div class="col-lg-12">
    <div style="display: flex;flex-wrap: wrap;">
        @foreach ($dataCategory as $dc)
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">{{ strtoupper($dc->name) }}</label>
                    @foreach ($data as $dt)
                        @if ($dc->name == $dt->cName)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="radio[{{$dt->radioId}}]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $dt->name }}
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
