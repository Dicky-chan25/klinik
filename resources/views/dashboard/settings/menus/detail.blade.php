@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Level User</h1>
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
    @if ($err = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <span class="text-sm">{{ $err }}</span>
        </div>
    @endif

    @include('dashboard.settings.menus.component.table_detail')

@endsection

@section('script')
<script>
    var id;
    var userName;

    // delete passing data to modal
    $(".menu-delete").on('click', function() {
        id = $(this).data("delmenuid");
        userName = $(this).data("delmenu");
        $("#delete-data-name").text('Apakah Anda yakin ingin menghapus ' + userName + '?');
    });
    // submit delete function
    $(".submit-delete").on('click', function() {
        window.location.href='/settings/menus/delete/'+id
    });
</script>
@endsection
