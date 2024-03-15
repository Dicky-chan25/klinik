<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <div class="">
            <h5 class="text-primary m-2">Detail Pasien</h5>
        </div>
        <div class="d-flex" style="gap:0.4rem">
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilihan</button>
                <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                    <div class="dropdown-menu dropdown-menu-end py-0 me-sm-n15 me-lg-0 o-hidden animated--fade-in-up show" aria-labelledby="navbarDropdownDocs" data-bs-popper="static">
                        <a class="dropdown-item py-3" href="{{route('rawatpasien-assesment', [ 'id' => $id ])}}">
                            <div class="icon-stack bg-primary-soft text-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                            <div>
                                Assesment
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="{{route('rawatpasien-onr', [ 'id' => $id ])}}">
                            <div class="icon-stack bg-primary-soft text-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                            <div>
                                Obat Non Racikan
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="{{route('rawatpasien-or', [ 'id' => $id ])}}">
                            <div class="icon-stack bg-primary-soft text-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                            <div>
                                Obat Racikan
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="{{route('rawatpasien-plan', [ 'id' => $id ])}}">
                            <div class="icon-stack bg-primary-soft text-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                            <div>
                                Tindakan
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3 active" href="{{route('rawatpasien-laborat', [ 'id' => $id ])}}">
                            <div class="icon-stack bg-primary-soft text-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                            <div>
                                Laborat
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="{{route('rawatpasien-riwayat', [ 'id' => $id ])}}">
                            <div class="icon-stack bg-primary-soft text-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                            <div>
                                Riwayat Pasien
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown">Cetak Surat</button>
                <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                    <a class="dropdown-item">Surat Ijin Sakit</a>
                    <a class="dropdown-item">Surat Keterangan Sehat</a>
                    <a class="dropdown-item">Surat Keterangan Sakit</a>
                    <a class="dropdown-item">Rujuk Pasien</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Nomor Registrasi</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{ $detailData->regNo }}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Nomor Rekam Medis</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{ $detailData->rmCode }}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Nama Pasien</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{$detailData->patientName}}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Jenis Kelamin</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{$detailData->gender === 1 ? 'Pria' : 'Wanita'}}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Tempat Tanggal Lahir Pasien</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{$detailData->birthDate}} ,{{$detailData->birthPlace}}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Alamat Pasien</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{$detailData->address}}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Cara Bayar</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: 123123123</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Dokter</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: {{$detailData->doctorName}}</h6>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-lg-2">
                <p>Alergi</p>
            </div>
            <div class="col-lg-10">
                <h6 class="text-primary font-weight-bold">: 123123123</p>
            </div>
        </div>
    </div>
</div>
