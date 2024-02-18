@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laborat</h1>
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

    @include('dashboard.master_data.laboratory.component.table')
@endsection



@section('script')
<script>
    var id;
    var name;

    // delete passing data to modal
    $(".data-delete").on('click', function() {
        id = $(this).data("delid");
        name = $(this).data("delname");
        $("#delete-data-name").text('Apakah Anda yakin ingin menghapus ' + name + '?');
    });
    // submit delete function
    $(".submit-delete").on('click', function() {
        window.location.href='/datamaster/laborat/delete/'+id
    });
</script>
@endsection