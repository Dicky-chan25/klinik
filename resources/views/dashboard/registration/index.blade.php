@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendaftaran</h1>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if ($err = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <span class="text-sm">{{ $err }}</span>
        </div>
    @endif
    @if ($success = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <span class="text-sm">{{ $success }}</span>
        </div>
    @endif

    @if ($access->read == 1)        
        @include('dashboard.registration.component.header')
        @include('dashboard.registration.component.table')
    @else
        @include('widget.404')
    @endif

   
@endsection



@section('script')
    <script>
        const searchParams = new URLSearchParams(window.location.search);
        const param = searchParams.get('search')
        $('#search').val(param);

        var id;
        var regNo;
        var name;

        // confirm passing data to modal
        $(".data-confirm").on('click', function() {
            id = $(this).data("confirmid");
            regNo = $(this).data("confirmregno");
            name = $(this).data("confirmname");
            console.log(id, regNo, name);
            $("#confirm-data-name").text('Apakah Anda yakin ingin melanjutkan ' + regNo + ' ke proses perawatan dengan nama ' + name + ' ? Data ini tidak dapat dirubah kembali');
        });
        // submit function
        $(".submit-data").on('click', function() {
            // alert('success')
            window.location.href='/pendaftaran/submit/'+id
        });
    </script>
@endsection
