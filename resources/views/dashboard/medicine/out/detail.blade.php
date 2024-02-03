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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Akses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                            </th>
                            <th>Nama Menu</th>
                            <th>Akses</th>
                            <th>Tambah</th>
                            <th>Ubah</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getMenu as $item)
                            <tr>
                                <td>
                                    <div class="form-check">

                                        <input class="form-check-input" id="status" type="checkbox" name="status"
                                            @if ($item->read == 1 && $item->create == 1 && $item->delete == 1 && $item->edit == 1) checked @endif>
                                    </div>
                                </td>
                                <td>
                                    {{ $item->menuName }}
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input read-onclick" id="status" type="checkbox"
                                            name="status" data-readvalue="{{ $item->read }}"
                                            data-accessid="{{ $item->accessId }}"
                                            @if ($item->read == 1) checked @endif>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input create-onclick" id="status" type="checkbox"
                                            name="status" data-createvalue="{{ $item->create }}"
                                            data-accessid="{{ $item->accessId }}"
                                            @if ($item->create == 1) checked @endif>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input edit-onclick" id="status" type="checkbox"
                                            name="status" data-editvalue="{{ $item->edit }}"
                                            data-accessid="{{ $item->accessId }}"
                                            @if ($item->edit == 1) checked @endif>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input delete-onclick" id="status" type="checkbox"
                                            name="status" data-deletevalue="{{ $item->delete }}"
                                            data-accessid="{{ $item->accessId }}"
                                            @if ($item->delete == 1) checked @endif>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var readValue;
        var createValue;
        var editValue;
        var deleteValue;
        var levelId = window.location.href.split('/').reverse()[0];

        $(".read-onclick").change(function() {
            readValue = $(this).attr("data-readvalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/read/' + readValue;
        });
        $(".create-onclick").change(function() {
            createValue = $(this).attr("data-createvalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/create/' + createValue;
        });
        $(".edit-onclick").change(function() {
            editValue = $(this).attr("data-editvalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/edit/' + editValue;
        });
        $(".delete-onclick").change(function() {
            deleteValue = $(this).attr("data-deletevalue");
            var id = $(this).data("accessid")
            window.location.href = '/settings/userlevels/detail/' + id + '/delete/' + deleteValue;
        });
    </script>
@endsection
