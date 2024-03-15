@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Obat</h1>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if ($err = Session::get('err'))
        <div class="alert alert-danger" role="alert">
            <span class="text-sm">{{ $err }}</span>
        </div>
    @endif
    
    @include('dashboard.medicine.component.form')
    
@endsection

@section('script')
    <script>

    $("#selectSupplier").on('select2:select', function (e) {
        console.log(e.params.data);
        $('.supplierOfficer').val(e.params.data.name)
        $('.supplierContact').val(e.params.data.contact)
    });
    $("#selectSupplier").select2({
        placeholder:'Pilih Supplier',
        theme: 'bootstrap-5',
        ajax: {
            url: "{{route('supplier-load')}}",
            dataType: 'json',
            data: function(term) {
                return term;
            },
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            id: item.id,
                            text: item.suppliername,
                            contact: item.officercontact,
                            name: item.officername
                        }
                    })
                }
            }
        }
    })
    </script>
@endsection