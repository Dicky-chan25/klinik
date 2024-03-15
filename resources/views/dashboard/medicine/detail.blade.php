@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Obat</h1>
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

    @include('dashboard.medicine.all.component.form_detail')
    @include('dashboard.medicine.all.component.table_detail')

@endsection

@section('script')
<script>
    var id;
    var userName;

    // delete passing data to modal
    $(".comp-delete").on('click', function() {
        id = $(this).data("delid");
        userName = $(this).data("deltitle");
        $("#delete-data").text('Apakah Anda yakin ingin menghapus data ' + userName + '?');
    });

    $(".comp-delete-detail").on('click', function() {
        id = $(this).data("delid");
        userName = $(this).data("deltitle");
        $("#delete-data-detail").text('Apakah Anda yakin ingin menghapus data ' + userName + '?');
    });
    // submit delete function
    $(".submit-delete").on('click', function() {
        window.location.href='/settings/users/delete/'+id
    });
    // submit delete detail function
    $(".submit-delete-detail").on('click', function() {
        window.location.href='/obat/semuaobat/delete/'+id
    });
</script>
@endsection