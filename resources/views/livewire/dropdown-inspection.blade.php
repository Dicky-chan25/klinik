
<div class="">
    <div class="form-group">
        <label for="prescript">Pilih Pemeriksaan Tambahan</label>
        <input id="inspectId" type="text" style="display: none" name="inspect" wire:model="keywordId" class="form-control" >
        <input id="inspectName" type="text" wire:change="keywordChange()" wire:model="keyword" class="form-control">
        <div class="btn btn-primary mt-2">Cari</div>
        <div class="">
            @if ($data != [])
                <div class="container rounded bg-info p-2 my-2">
                    @foreach ($data as $md)
                     <div class="" onClick="selectedMdc('{!!$md->info!!}','{!!$md->price!!}','{!!$md->title!!}',{!!$md->id!!})">
                         <p class="text-light" style="cursor: pointer">{{$md->title}}</p>
                     </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="form-group" style="{{$price == 0 || $price == null ? 'display:none' : 'display:block' }}">
        <label for="prescript">Keterangan Pemeriksaan</label>
        <div class="">
            <p style="margin-top:-10px;">Harga : <span style="font-weight: bold">Rp. {{number_format($price)}}</span></p>
            <p style="margin-top:-10px;">Informasi : <br><span>{{$info}}</span></p>
        </div>
    </div>
</div>

<script>
    const selectedMdc = (info,price, name, id) => {
        document.getElementById('inspectId').setAttribute('value', id)
        document.getElementById('inspectName').setAttribute('value', name)
        @this.set('info', info);
        @this.set('price', price);
        @this.set('keyword', name);
        @this.set('keywordId', id);
        @this.set('isClose', true);
    }
</script>

