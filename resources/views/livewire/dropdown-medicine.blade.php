
<div>
    <input id="patientId" type="text" style="display: none" name="patient" wire:model="keywordId" class="form-control" >
    <input id="patientName" type="text" wire:change="keywordChange()" wire:model="keyword" class="form-control">
    <div class="btn btn-primary mt-2">Cari</div>
    <div class="" id="cardListPatient">
        @if ($data != [])
            <div class="container rounded bg-info p-2 my-2">
                @foreach ($data as $dp)
                    <p class="text-light" style="cursor: pointer" onClick="selectedPatient('{!!$dp->patientname!!}',{!!$dp->id!!})">{{$dp->patientname}}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>

@section('script')
    <script>
        const selectedPatient = (name, id) => {
            document.getElementById('patientId').setAttribute('value', id)
            document.getElementById('patientName').setAttribute('value', name)
            @this.set('keyword', name);
            @this.set('keywordId', id);
            @this.set('isClose', true);
        }
    </script>
@endsection
