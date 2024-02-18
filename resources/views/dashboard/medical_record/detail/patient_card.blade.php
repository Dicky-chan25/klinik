
<div class=""  style="width:30%;">
    <div class="card shadow mb-4 p-3">
        <p class="text-primary" style="font-weight: bold">Detail Pribadi</p>
        <hr style="margin-top:-10px">
        <div class="d-flex" style="">
            <p style="width: 150px;">Kode RM</p>
            <p style="text-align:left !important;max-width:250px;">{{$dataPatient->code}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Nama Pasien</p>
            <p style="text-align:left !important;max-width:250px;">{{$dataPatient->patientName}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">NIK</p>
            <p style="text-align:left !important;max-width:250px;">{{$dataPatient->nik}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Gender / Usia</p>
            <p style="text-align:left !important;max-width:250px;">{{ Carbon\Carbon::parse($dataPatient->birthDate)->age .' / '. ($dataPatient->gender == 1 ? 'Pria' : 'Wanita')}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Tanggal Lahir</p>
            <p style="text-align:left !important;max-width:250px;">{{ $dataPatient->birthDate}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Alamat</p>
            <p style="text-align:left !important;max-width:250px;">{{ $dataPatient->address}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Suku/Bahasa</p>
            {{-- 1->indonesia ; 2->international ; 3->bahasa daerah --}}
            @if ($dataPatient->language == 1)
            <p style="text-align:left !important;max-width:250px;">Indonesia</p>
            @endif
            @if ($dataPatient->language == 2)
            <p style="text-align:left !important;max-width:250px;">Internasional</p>
            @endif
            @if ($dataPatient->language == 3)
            <p style="text-align:left !important;max-width:250px;">Bahasa Daerah</p>
            @endif
        </div>
        <br>
        <p class="text-primary" style="font-weight: bold">Detail Kunjungan</p>
        <hr style="margin-top:-10px">
        <div class="d-flex" style="">
            <p style="width: 150px;">No. Reg</p>
            <p style="text-align:left !important;max-width:250px;">{{ $dataPatient->reg}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">No. Antrian</p>
            <p style="text-align:left !important;max-width:250px;">{{ $dataPatient->queue}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Tgl Kunjungan</p>
            <p style="text-align:left !important;max-width:250px;">{{ date('d-m-Y', strtotime($dataPatient->createdAt))}}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Jenis Poli</p>
            <p style="text-align:left !important;max-width:250px;">{{ $dataPatient->poliName }}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Jenis Layanan</p>
            <p style="text-align:left !important;max-width:250px;">{{ $dataPatient->serviceName }}</p>
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Pembayaran</p>
            @if ($dataPatient->payment == 0)
            <p style="text-align:left !important;max-width:250px;">Tunai</p>
            @endif
            @if ($dataPatient->payment == 1)
            <p style="text-align:left !important;max-width:250px;">Transfer</p>
            @endif
            @if ($dataPatient->payment == 2)
            <p style="text-align:left !important;max-width:250px;">BPJS</p>
            @endif
        </div>
        <div class="d-flex" style="margin-top:-10px;">
            <p style="width: 150px;">Diagnosis Awal</p>
            <p style="text-align:left !important;max-width:250px;">{{ $dataPatient->fdiagnose }}</p>
        </div>
        <br>
    </div>
</div>