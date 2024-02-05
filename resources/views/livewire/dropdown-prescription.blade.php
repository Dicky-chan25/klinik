<div class="">
    <div class="form-group">
        <label for="medicine">Pilih Obat</label>
        <input id="medicineId" type="text" style="display: none" name="medicine" wire:model="keywordId">
        <input id="medicineName" type="text" wire:change="keywordChange()" wire:model="keyword" class="form-control">
        <div class="btn btn-primary mt-2">Cari</div>
        @error('medicine')
            <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
        @enderror
        <div class="" id="containerList">
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
    <div class="form-group">
        <label for="prescript">Pilih Dosis Obat</label>
        <div class="" style="{{$preDosePerDay == '' || $preDosePerDay == null ? 'display:none' : 'display:block' }}">
            <input id="preId" type="text" style="display: none" name="prescript" wire:model="keywordPreId" value="{{$keywordPreId}}">
            <p>Dosis Per Hari : <span style="font-weight: bold">{{$preDosePerDay}}</span></p>
            <p style="margin-top:-10px;">Berat : <span style="font-weight: bold">{{$preInfo}}</span></p>
            <p style="margin-top:-10px;">Dikonsumsi : <span style="font-weight: bold">{{$preStatus}}</span></p>
            <p style="margin-top:-10px;">Untuk umur : <span style="font-weight: bold">{{$preAgeRange}}</span></p>
        </div>
        <div class="" id="containerListDose">
            @foreach ($dataPre as $pre)
                <div class="bg-info text-light p-2 my-2 rounded" onClick="selectedPre(
                '{!!$pre->dosePerDay!!}',
                '{!!$pre->info!!}',
                '{!!$pre->eatStatus!!}',
                '{!!$pre->ageRange!!}',
                {!!$pre->detailId!!}
                )" style="cursor: pointer;">
                    <p style="">Dosis per hari : {{$pre->dosePerDay}}</p>
                    <p style="margin-top:-20px !important;">Berat : {{$pre->info}}</p>
                    <p style="margin-top:-20px !important;">Dikonsumsi : {{$pre->eatStatus == 1 ? 'Sebelum Makan' : 'Sesudah Makan' }}</p>
                    <p style="margin-top:-20px !important;">Untuk umur : {{$pre->ageRange}}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    const selectedMdc = (name, id) => {
        document.getElementById('medicineId').setAttribute('value', id)
        document.getElementById('medicineName').setAttribute('value', name)
        document.getElementById('containerList').style.display = 'none'
        @this.set('keyword', name);
        @this.set('keywordId', id);
        @this.set('isClose', true);
        @this.set('isPreClose', false);
        document.getElementById('preId').setAttribute('value', '')
       
    }
    const selectedPre = (dose,info,status,age,id) => {
        @this.set('keywordPreId', id);
        @this.set('isPreClose', true);
        @this.set('preDosePerDay',dose)
        @this.set('preInfo',info)
        @this.set('preStatus',status == 1 ? 'Sebelum Makan' : 'Sesudah Makan' )
        @this.set('preAgeRange',age)
    }
</script>