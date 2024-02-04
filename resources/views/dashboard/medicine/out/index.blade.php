@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Stock Obat Keluar</h1>
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

    @include('dashboard.medicine.out.component.form')
    @include('dashboard.medicine.out.component.table')
@endsection

@section('script')
    <script>
        var id;
        var userName;

        // delete passing data to modal
        $(".data-delete").on('click', function() {
            id = $(this).data("delid");
            userName = $(this).data("deldata");
            $("#delete-data-name").text('Apakah Anda yakin ingin menghapus ' + userName + '?');
        });
        // submit delete function
        $(".submit-delete").on('click', function() {
            // validate qty
            window.location.href = '/obat/obatmasuk/delete/' + id
        });
    </script>

    {{-- <script>
        $(".per-item").addClass("active");
        $(".barcode").css("display","block");
        $(".product").css("display","none");

        $(".per-item").on('click', function() {
            $(".per-item").addClass("active");
            $(".per-qty").removeClass("active");
            $(".barcode").css("display","block");
            $(".product").css("display","none");
        });
        $(".per-qty").on('click', function() {
            $(".per-qty").addClass("active");
            $(".per-item").removeClass("active");
            $(".product").css("display","block");
            $(".barcode").css("display","none");
        });
    </script> --}}
@endsection
