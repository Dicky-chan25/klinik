
<div>
    <input id="medicineId" type="text" style="display: none" name="medicine" wire:model="keywordId" class="form-control" >
    <input id="medicineName" type="text" wire:change="keywordChange()" wire:model="keyword" class="form-control">
    <div class="btn btn-primary mt-2">Cari</div>
    <div class="">
        @if ($data != [])
            <div class="container rounded bg-info p-2 my-2">
                @foreach ($data as $md)
                 <div class="" onClick="selectedMdc('{!!$md->medicinename!!}',{!!$md->id!!})">
                     <p class="text-light" style="cursor: pointer">{{$md->medicinename}} - {{$md->code}}</p>
                 </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    const selectedMdc = (name, id) => {
        document.getElementById('medicineId').setAttribute('value', id)
        document.getElementById('medicineName').setAttribute('value', name)
        @this.set('keyword', name);
        @this.set('keywordId', id);
        @this.set('isClose', true);
    }
</script>

