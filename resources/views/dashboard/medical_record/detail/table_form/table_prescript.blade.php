<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead class="bg-dark text-light">
            <tr>
                <th scope="col" class="text-center">Obat</th>
                <th scope="col" class="text-center">Jumlah</th>
                <th scope="col" class="text-center">Stock</th>
                <th scope="col" class="text-center">Aturan</th>
                <th scope="col" class="text-center">HET</th>
                <th scope="col" class="text-center">Harga</th>
                <th scope="col" class="text-center">Tuslah</th>
                <th scope="col" class="text-center">Sub Total</th>
                <th scope="col" class="text-center">
                    {{-- <div id="addPre" class="btn btn-info btn-sm text-light"><i class="fas fa-plus"></i></div> --}}
                </th>
            </tr>
        </thead>
        <tbody id="tablePre">
            {{-- Form Table --}}
            @foreach ($tableSelected as $key => $ts)
                <input type="text" style="display: none" value="{{ $ts['reg'] }}" name="prescript[{{$key}}][mdc_reg]">
                <input type="text" style="display: none" value="{{ $ts['name'] }}" name="prescript[{{$key}}][mdc_name]">
                <input type="text" style="display: none" value="{{ $ts['medicineId'] }}" name="prescript[{{$key}}][mdc_id]">
                <input type="text" style="display: none" value="{{ $ts['stockId'] }}" name="prescript[{{$key}}][stock_id]">
                <input type="text" style="display: none" value="{{ $qty }}" name="prescript[{{$key}}][qty]">
                <tr>
                    <td style="width:245px;">
                        <div style="width:240px; display:flex;margin-bottom:8px;gap:4px;">
                            <input style="width:50%" type="text" class="form-control form-control-sm" disabled
                                value="{{ $ts['reg'] }}">
                            <input style="width:50%" type="text" class="form-control form-control-sm" disabled
                                value="{{ $ts['name'] }}">
                        </div>
                        <div style="width:240px; display:flex;margin-bottom:8px;gap:4px;">
                            <input style="width:20%" type="text" class="form-control form-control-sm" disabled
                                value="{{ $ts['batch'] }}">
                            <input style="width:100%" type="text" class="form-control form-control-sm" disabled
                                value="{{ $ts['exp'] }}">
                        </div>
                    </td>
                    <td style="width:120px;">
                        <div style="width:100%; display:flex;margin-bottom:8px;gap:4px;">
                            <input type="text" class="form-control form-control-sm" wire:change="qtyChange()" wire:model="qty">
                            <input type="text" class="form-control form-control-sm" disabled value="{{ $ts['unit'] }}">
                        </div>
                        <div class="btn btn-primary btn-sm">Ubah</div>
                    </td>
                    <td style="width:45px;">
                        <input style="width:100%" type="text" class="form-control form-control-sm" disabled value="{{ $ts['stockTotal'] - $ts['stockOut'] }}">
                    </td>
                    <td style="width:245px;">
                        <div class="d-flex">
                            <input style="width:40%" type="text" class="form-control form-control-sm"
                                value="{{ $ts['doseMax'] }}" name="prescript[{{$key}}][dose]">
                                <p class="m-1">x Sehari</p>
                        </div>
                        <input style="width:100%" type="text" class="form-control form-control-sm"
                            value="{{ $ts['eatStatus'] == 1 ? 'Sebelum Makan':'Sesudah Makan' }}" name="prescript[{{$key}}][eating]">

                        <input style="width:100%" type="text" class="form-control form-control-sm"
                            value="PAGI, SIANG, MALAM" name="prescript[{{$key}}][time]">
                    </td>
                    <td style="width:100px;">
                        <input style="width:100%" type="text" class="form-control form-control-sm" disabled value="{{ $ts['het'] }}">
                    </td>
                    <td style="width:100px;">
                        <input style="width:100%" type="text" class="form-control form-control-sm" disabled value="{{ $ts['price'] }}">
                    </td>
                    <td style="width:100px;">
                        <input style="width:100%" type="text" class="form-control form-control-sm" disabled value="{{ $tuslah }}">
                    </td>
                    <td style="width:100px;">
                        <input style="width:100%" type="text" class="form-control form-control-sm"
                            value="{{ $tuslah + $ts['price'] * $qty }}" name="prescript[{{$key}}][total]">
                    </td>
                    <td class="text-center" style="width:45px">
                        <div class="m-1" wire:click="remove({{ $key }})">
                            <div id="removePre" class="btn btn-danger btn-sm text-light"><i class="fas fa-trash"></i></div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>