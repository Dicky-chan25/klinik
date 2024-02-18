@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Input Resep Online</h1>
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
    
    <div class="d-flex justify-content-between">
        <div class="col-lg-8 card shadow mb-4 p-3">
            <form method="POST" action="{{ route('rekammedis-create-resep', ['id' => $idMr]) }}">
                @csrf
                <div class="form-group">
                    {{-- <label for="code">Kode Resep Obat</label> --}}
                    <input name="code" type="text" style="display: none" value="{{ $mCode }}">
                </div>
                <livewire:dropdown-prescription />
                <div class="form-group">
                    <label for="qty">Jumlah Obat</label>
                    <input @error('qty') style="border:1px solid #ff0000;" @enderror name="qty"
                        type="number" value="{{ old('qty') }}" class="form-control" id="qty"
                        placeholder="qty">
                    @error('qty')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="info">Informasi Tambahan</label>
                    <textarea style="resize: none" @error('info') style="border:1px solid #ff0000;" @enderror name="info"
                        type="text" class="form-control" id="info" placeholder="info">{{ old('info') }}</textarea>
                    @error('info')
                        <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                    @enderror
                </div>

                <br>
                <div class="justify-content-between d-flex">
                    <div class=""></div>
                    <button type="submit" class="btn btn-primary">Simpan & Buat Resep Obat</button>
                </div>
            </form>
        </div>
        @include('dashboard.medical_record.detail.patient_card')
    </div>
    
    @include('dashboard.medical_record.component.table_resep')
    
@endsection