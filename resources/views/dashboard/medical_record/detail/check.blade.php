@extends('dashboard-layout.main')

@section('dashboard')
    <div class="" style="display:flex !important;flex-direction:row !important;gap:1rem">
        <div class="" style="width:70%">
            <div class="card shadow mb-4 p-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Pemeriksaan Medis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tindakan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Resep</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ringkasan Biaya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">EMR</a>
                    </li>
                </ul>
                <br>
                <div class="mt-4 px-2">
                    <div class="d-flex justify-content-between" id="soapHeader">
                        <h5>SOAP (Subjective, Objective, Assessment, dan Plan)</h5>
                        <a href="" data-toggle="collapse" data-target="#soapAdmin">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <hr style="margin-top:-2px;">
                    @if ($dataPatient->status == 3)
                        @include('dashboard.medical_record.detail.check_doctor')
                    @endif
                    @if ($dataPatient->status == 0 || $dataPatient->status == 1 || $dataPatient->status == 2)
                        @include('dashboard.medical_record.detail.check_nurse')
                    @endif
                </div>

                <div class="mt-4 px-2">
                    <div class="d-flex justify-content-between" id="cpptHeader">
                        <h5>CPPT (Catatan Perkembangan Pasien Terintegrasi)</h5>
                        <a href="" data-toggle="collapse" data-target="#cpptAdmin">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <hr style="margin-top:-2px;">
                    @include('dashboard.medical_record.detail.cppt')
                </div>

                <div class="mt-4 px-2">
                    <div class="d-flex justify-content-between" id="msgHeader">
                        <h5>SURAT - SURAT</h5>
                        <a href="" data-toggle="collapse" data-target="#msgAdmin">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <hr style="margin-top:-2px;">
                    <div id="msgAdmin" class="collapse">

                        <div class="row">
                            <div class="col-lg-3">

                                @include('dashboard.medical_record.detail.modal_letter.rujukan')
                                <a id="openRujukanLetter">
                                    <div style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                                        Surat Rujukan</div>
                                </a>
                                <a href="#" data-target="#rujukanLetter" data-toggle="modal" style="text-decoration:none !important">
                                    <div style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                                        Surat Rujuk Balik</div>
                                </a>
                                <a href="#" data-target="#rujukanLetter" data-toggle="modal" style="text-decoration:none !important">
                                    <div style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                                        Surat Pengantar Rawat Inap</div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#" data-target="#rujukanLetter" data-toggle="modal" style="text-decoration:none !important">
                                    <div style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                                        Surat Keterangan Dokter</div>
                                </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="#" data-target="#rujukanLetter" data-toggle="modal" style="text-decoration:none !important">
                                    <div style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                                        Surat Konsul Gizi</div>
                                </a>
                                <a href="#" data-target="#rujukanLetter" data-toggle="modal" style="text-decoration:none !important">
                                    <div style="background-color:rgb(52, 65, 154);margin-bottom:4px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                                        Surat Keterangan Lahir</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.medical_record.detail.patient_card')
    </div>
@endsection

@section('script')
    @if ($dataPatient->status == 3)
        @include('dashboard.medical_record.detail.all_script.script')
    @endif
   {{-- OPEN MODAL JQUERY --}}
    <script>
        // Open Modal Rujuan Letter
        $("#openRujukanLetter").on('click', function(){
            $('#rujukanLetter').modal('show');
        })


        // Open Modal Prescript
        $("#openPrescriptModal").on('click', function(){
            $('#resepOnline').modal('show');
        })
        // Open Modal Laboratory
        $("#openLabModal").on('click', function(){
            $('#labOnline').modal('show');
        })
        // Open Modal Radio
        $("#openRadioModal").on('click', function(){
            $('#radioOnline').modal('show');
        })
        // Open Modal ME
        $("#openMeModal").on('click', function(){
            $('#meOnline').modal('show');
        })
        // Open Modal Cppt
        $("#openCpptModal").on('click', function(){
            $('#cpptOnline').modal('show');
        })
    </script>
@endsection