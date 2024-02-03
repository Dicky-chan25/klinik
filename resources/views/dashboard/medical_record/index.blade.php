@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rekam Medis</h1>
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
    @if ($warning = Session::get('warning'))
        <div class="alert alert-warning" role="alert">
            <span class="text-sm">{{ $warning }}</span>
        </div>
    @endif

    @include('dashboard.medical_record.component.table')
@endsection



@section('script')
<script>
    var id;
    var userName;

    // delete passing data to modal
    $(".userpatient-delete").on('click', function() {
        id = $(this).data("delpatientid");
        userName = $(this).data("deluserpatient");
        $("#delete-data-name").text('Apakah Anda yakin ingin menghapus ' + userName + '?');
    });
    // submit delete function
    $(".submit-delete").on('click', function() {
        window.location.href='/settings/userpatients/delete/'+id
    });
</script>
@endsection