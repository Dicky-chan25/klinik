@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Dokter</h1>
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
    
    @include('dashboard.doctor.component.form')
    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#selectStaff").on('select2:select', function (e) {
                $('.codeStaff').val(e.params.data.code)
            });
            $("#selectStaff").select2({
                placeholder:'Pilih Pegawai Dokter',
                theme: 'bootstrap-5',
                ajax: {
                    url: "{{route('staff-load')}}",
                    dataType: 'json',
                    data: function(term) {
                        return term;
                    },
                    processResults: function(data){
                        return {
                            results: $.map(data, function(item){
                                return {
                                    id: item.id,
                                    text: item.name,
                                    code: item.code
                                }
                            })
                        }
                    }
                }
            })
            $("#selectSpecialize").select2({
                placeholder:'Pilih Spesialisasi Dokter',
                theme: 'bootstrap-5',
                ajax: {
                    url: "{{route('specialize-load')}}",
                    dataType: 'json',
                    data: function(term) {
                        return term;
                    },
                    processResults: function(data){
                        return {
                            results: $.map(data, function(item){
                                return {
                                    id: item.id,
                                    text: item.title,
                                    code: item.code
                                }
                            })
                        }
                    }
                }
            })
            $("#selectUser").select2({
                placeholder:'Pilih Akun Teregistrasi',
                theme: 'bootstrap-5',
                ajax: {
                    url: "{{route('dr-account-load')}}",
                    dataType: 'json',
                    data: function(term) {
                        return term;
                    },
                    processResults: function(data){
                        return {
                            results: $.map(data, function(item){
                                return {
                                    id: item.id,
                                    text: `${item.email} - (${item.doctorcode})`,
                                    code: item.code
                                }
                            })
                        }
                    }
                }
            })
        })
    </script>
@endsection