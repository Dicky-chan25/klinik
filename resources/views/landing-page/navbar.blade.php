{{-- Navbar --}}
<div class="nav-row">
    <div class="nav-container-logo">
        <img class="nav-logo" src="{{asset('img/nav-logo.png')}}" alt="nav-logo">
        <p class="nav-logo-text">Praktik Mandiri Dokter Asep</p>
    </div>
    <div class="nav-menu">
        <a href="/" class="nav-item">Home</a>
        <a href="#about" class="nav-item">Tentang</a>
        <a href="#step" class="nav-item">Tahapan</a>
        <a href="{{route('history')}}" class="nav-item">Antrian</a>
    </div>
    <div class="nav-button">
        <a href="{{route('login')}}"  class="nav-btn-login">Login</a>
    </div>
</div>
{{-- End Navbar --}}