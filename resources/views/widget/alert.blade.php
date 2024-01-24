{{-- Alert --}}
@if (Session::has('success'))
<div class="alert alert-success m-4" role="alert">
    {{Session::get('success')}}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger m-4" role="alert">
    {{Session::get('error')}}
</div>
@endif
{{-- @foreach ($errors->all() as $error)
<div class="alert alert-danger m-4">{{ $error }}</div>
@endforeach --}}
{{-- Alert --}}