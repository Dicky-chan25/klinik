@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Proses Rekam Medis</h1>
        <h5>Admin</h5>
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medis</h6>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between">
                <h5>Data Admin</h5>
                <a href="" data-toggle="collapse" data-target="#collapseAdmin">
                    <i class="fa fa-angle-down"></i>
                </a>
            </div>
            <hr>
            <div id="collapseAdmin" class="collapse" data-parent="#accordionSidebar">
                <div class="form-group">
                    <label for="code">Kode Rekam Medis</label>
                    <input disabled class="form-control" value="{{ $dataMr->code }}" />
                </div>
                <div class="form-group">
                    <label for="code">Nama Pasien</label>
                    <input disabled class="form-control" value="{{ $dataMr->patientName }}" />
                </div>
                <div class="form-group">
                    <label for="code">Nama Layanan</label>
                    <input disabled class="form-control" value="{{ $dataMr->serviceName }}" />
                </div>
                <div class="form-group">
                    <label for="code">Nama Poli</label>
                    <input disabled class="form-control" value="{{ $dataMr->poliName }}" />
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5>Data Perawat</h5>
                <a href="" data-toggle="collapse" data-target="#collapseNurse">
                    <i class="fa fa-angle-down"></i>
                </a>
            </div>
            <hr>
            <div id="collapseNurse" class="collapse" data-parent="#accordionSidebar">
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 48%">
                        <label for="code">Berat Badan (kg)</label>
                        <input disabled class="form-control" value="{{ $dataMr->weight }}" />
                    </div>
                    <div class="form-group" style="width: 48%">
                        <label for="code">Tinggi Badan (cm)</label>
                        <input disabled class="form-control" value="{{ $dataMr->height }}" />
                    </div>
                </div>
                <div class="row mx-auto justify-content-between ">
                    <div class="form-group" style="width: 48%">
                        <label for="code">Lingkar Pinggang</label>
                        <input disabled class="form-control" value="{{ $dataMr->waist }}" />
                    </div>
                    <div class="form-group" style="width: 48%">
                        <label for="code">Jenis Darah</label>
                        <input disabled class="form-control" value="{{ $dataMr->blood }}" />
                    </div>
                </div>

                <p>Keluhan / Anamnesis</p>
                <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $dataMr->complain }}</textarea>
                <br>
                <p>Diagnosa</p>
                <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $dataMr->diagnose }}</textarea>
                <br>
            </div>
            <div class="d-flex justify-content-between">
                <h5>Data Dokter</h5>
                <a href="" data-toggle="collapse" data-target="#collapseDoctor">
                    <i class="fa fa-angle-down"></i>
                </a>
            </div>
            <hr>
            <div id="collapseDoctor" class="collapse" data-parent="#accordionSidebar">
                <div class="form-group">
                    <label for="code">Nama Dokter</label>
                    <input disabled class="form-control" value="{{ $dataMr->doctorName }}" />
                </div>
                <div class="form-group">
                    <p>Tindakan</p>
                    <textarea class="form-control" rows="4" style="resize: none" disabled>{{ $dataMr->action }}</textarea>
                    <br>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5>Data Pembayaran</h5>
            </div>
            <hr>

            <div class="d-flex justify-content-between">
                <div class="col-lg-6 mx-auto">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="" class="text-primary">Biaya Konsultasi Dokter</label>
                            <div class="form-group">Rp. {{ number_format($dataMr->doctorPrice) }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <p class="text-primary">Biaya Resep Obat</p>
                        <br>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($allPrescription as $alp)
                            <div class="d-flex justify-content-between" style="margin-top:-10px;">
                                <p>Nama Obat :</p>
                                <p>{{ $alp->nameMedicine }} ({{ $alp->qty }}) / Rp.
                                    {{ number_format($alp->priceMdc) }} / Item</p>
                            </div>
                            <div class="d-flex justify-content-between" style="margin-top:-10px">
                                <p>Harga Obat Total :</p>
                                <p>Rp. {{ number_format($alp->priceMdc * $alp->qty) }}</p>
                            </div>
                            <br>
                            @php
                                $total += $alp->priceMdc * $alp->qty;
                            @endphp
                        @endforeach
                        <div class="d-flex justify-content-between">
                            <label for="">Biaya Total Semua Obat</label>
                            <div class="form-group">Rp. {{ number_format($total) }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <p class="text-primary">Biaya Pemeriksaan Tambahan</p>
                        <br>
                        @php
                            $totalIsp = 0;
                        @endphp
                        @foreach ($allInspect as $alisp)
                            <div class="d-flex justify-content-between" style="margin-top:-10px;">
                                <p>Nama Pemeriksaan :</p>
                                <p>{{ $alisp->ispName }}</p>
                            </div>
                            <div class="d-flex justify-content-between" style="margin-top:-10px">
                                <p>Harga :</p>
                                <p>Rp. {{ number_format($alisp->price) }}</p>
                            </div>
                            <br>
                            @php
                                $totalIsp += $alisp->price;
                            @endphp
                        @endforeach
                        <div class="d-flex justify-content-between">
                            <label for="">Biaya Total Semua Pemeriksaan</label>
                            <div class="form-group">Rp. {{ number_format($totalIsp) }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="" class="text-primary">Biaya Total Rekam Medis</label>

                            <h4 style="font-weight: bold" class="text-danger">Rp.
                                {{ number_format($dataMr->doctorPrice + $total + $totalIsp) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mx-auto">

                    @if (is_null($paymentData))
                        <form method="POST" action="{{ route('rekammedis-submit-cashier', ['id' => $dataMr->id]) }}">
                            @csrf
                            <input type="text" style="display: none" name="total_price"
                                value="{{ $dataMr->doctorPrice + $total + $totalIsp }}">
                            <div class="form-group">
                                <label for="paymethod">Pilih Metode Pembayaran</label>
                                <input type="text" id="method" name="method" style="display: none" />
                                <div class="d-flex" style="gap: 1rem">
                                    <div class="" id="cash">Tunai</div>
                                    <div class="" id="transfer">Transfer</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Nominal yang dibayarkan</label>
                                <input @error('nominal') style="border:1px solid #ff0000;" @enderror type="number"
                                    name="nominal" class="form-control" value="{{ old('nominal') }}">
                                @error('nominal')
                                    <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="accountNumber">
                                <div class="">
                                    <label for="" class="text-primary">Nama Bank</label>
                                    <p style="font-weight: bold;margin-top:-5px">Bank BCA</p>
                                </div>
                                <div class="">
                                    <label for="" class="text-primary">Nomor Rekening</label>
                                    <p style="font-weight: bold;margin-top:-5px">123123123</p>
                                </div>
                                <div class="">
                                    <label for="" class="text-primary">Nama Akun</label>
                                    <p style="font-weight: bold;margin-top:-5px">A.N. Klink Dokter Asep</p>
                                </div>
                            </div>
                            <div class="justify-content-between d-flex">
                                <div class=""></div>
                                <button id="cashSubmit" type="submit" name="type" value="0"
                                    class="btn btn-primary">Submit
                                    Pembayaran</button>
                                <button id="transferSubmit" type="submit" name="type" value="1"
                                    class="btn btn-primary">Submit
                                    Pembayaran</button>
                            </div>
                        </form>
                    @else
                        <h5>Data Pembayaran</h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <label for="" class="text-primary">Total Pembayaran</label>
                            <p style="font-weight: bold;margin-top:-5px">Rp.
                                {{ number_format($paymentData->total_price) }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <label for="" class="text-primary">Metode Pembayaran</label>
                            <div class="">
                                @if ($paymentData->method == 0)
                                    <div class="btn btn-primary btn-sm">Tunai</div>
                                @endif
                                @if ($paymentData->method == 1)
                                    <div class="btn btn-primary btn-sm">Transfer</div>
                                @endif
                                <br>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <label for="" class="text-primary">Pasien Membayar</label>
                            <p style="font-weight: bold;margin-top:-5px">Rp. {{ number_format($paymentData->nominal) }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <label for="" class="text-primary">Pasien Kembalian</label>
                            <p style="font-weight: bold;margin-top:-5px">Rp. {{ number_format($paymentData->return) }}</p>
                        </div>
                        <br>
                        <div class="justify-content-between d-flex">
                            <div class=""></div>
                            <a href="{{ route('rekammedis-finish', ['id' => $dataMr->id]) }}">
                                <div class="btn btn-primary">Tutup Rekam Medis</div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <br>

        </div>
    </div>

    @include('dashboard.medical_record.component.table_resep')
    @include('dashboard.medical_record.component.table_inspect')
@endsection

@section('script')
    <script>
        $('#cash').addClass('btn btn-primary');
        $('#transfer').addClass('btn btn-secondary');
        $("#cashSubmit").css("display", "block");
        $("#transferSubmit").css("display", "none");
        $("#accountNumber").css("display", "none");

        $('#cash').on('click', function() {
            $('#cash').attr('class', '');
            $('#transfer').attr('class', '');
            $('#cash').addClass('btn btn-primary');
            $('#transfer').addClass('btn btn-secondary');
            $("#accountNumber").css("display", "none");
            $("#cashSubmit").css("display", "block");
            $("#transferSubmit").css("display", "none");
        });
        $('#transfer').on('click', function() {
            $('#cash').attr('class', '');
            $('#transfer').attr('class', '');
            $('#cash').addClass('btn btn-secondary');
            $('#transfer').addClass('btn btn-primary');
            $("#accountNumber").css("display", "block");
            $("#cashSubmit").css("display", "none");
            $("#transferSubmit").css("display", "block");
        });
    </script>
@endsection
