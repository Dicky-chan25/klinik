<!-- Modal -->
<div class="modal fade" id="cpptOnline">
    <div class="modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form CPPT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success m-4 cpptMsgSuccess"></div>
            <div class="alert alert-danger m-4 cpptMsgError"></div>
    
            <form action="{{ route('cppt-post', ['rmId' => $id]) }}" method="POST" id="cpptCreate">
                @csrf
                <div class="modal-body" id="modal-bill-data" style="max-height: 40rem;overflow-auto">
                    <div class="row">
                        <div class="col-lg-6">

                            <p class="text-primary" style="font-weight: bold">Tanggal Pencatatan*</p>
                            <div class="form-group">
                                <input type="date" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-primary" style="font-weight: bold">Pilih Profesi*</p>
                            <div class="form-group">
                                <select name="" id="" class="form-control">
                                    <option value="">Dokter</option>
                                    <option value="">Perawat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <p class="text-primary" style="font-weight: bold">Vital Sign*</p>
                    <div class="form-group" style="gap: 10px; display:flex">
                        <div class="">
                            <label for="">Tekanan Darah (<span>Prehipertensi</span>)</label>
                            <div class="d-flex">
                                @php
                                    $explodeBp = explode('/', $mrNurse->vs_bp);
                                @endphp
                                <div class="">
                                    <input value="{{ $explodeBp[0] }}" name="bloodpress"
                                        @error('bloodpress') style="border:1px solid #ff0000;" @enderror
                                        type="number" class="form-control">
                                </div>
                                <div class="mx-2 mt-2">
                                    <p>/</p>
                                </div>
                                <div class="d-flex">
                                    <input value="{{ $explodeBp[1] }}" name="bloodpress2"
                                        @error('bloodpress2') style="border:1px solid #ff0000;" @enderror
                                        type="number" class="form-control">
                                    <div class="mx-2 mt-2">
                                        <p>Kali</p>
                                    </div>
                                </div>
                            </div>
                            @error('bloodpress')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="">Heart Rate (<span>Normal</span>)</label>
                            <div class="d-flex">
                                <input value="{{ $mrNurse->vs_hr }}" name="heartrate"
                                    @error('heartrate') style="border:1px solid #ff0000;" @enderror
                                    type="number" class="form-control">
                                <div class="mx-2 mt-2">
                                    <p>Kali</p>
                                </div>
                            </div>
                            @error('heartrate')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="">Resp Rate</label>
                            <div class="d-flex">
                                <input value="{{ $mrNurse->vs_rr }}" name="resprate" type="number" class="form-control"
                                    @error('resprate') style="border:1px solid #ff0000;" @enderror>
                                <div class="mx-2 mt-2">
                                    <p>Kali</p>
                                </div>
                            </div>
                            @error('resprate')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="">Temp (<span>Normal</span>)</label>
                            <div class="d-flex">
                                <input value="{{ $mrNurse->vs_temp }}" name="temp" type="number"
                                    class="form-control" @error('temp') style="border:1px solid #ff0000;" @enderror>
                                <div class="mx-2 mt-2">
                                    <p>*C</p>
                                </div>
                            </div>
                            @error('temp')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="">Sp02</label>
                            <div class="d-flex">
                                <input value="{{ $mrNurse->vs_sp }}" name="sp" type="number" class="form-control"
                                    @error('sp') style="border:1px solid #ff0000;" @enderror>
                                <div class="mx-2 mt-2">
                                    <p>%</p>
                                </div>
                            </div>
                            @error('sp')
                                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <p class="text-primary" style="font-weight: bold">S(Subjektif)*</p>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="subject"></textarea>
                    </div>
                    <p class="text-primary" style="font-weight: bold">O(Objektif)*</p>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="object"></textarea>
                    </div>
                    <p class="text-primary" style="font-weight: bold">A(Analisa Data)*</p>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="analysis"></textarea>
                    </div>
                    <p class="text-primary" style="font-weight: bold">P(Planning / Perencanaan)*</p>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="plan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan CPPT</button>
                </div>
            </form>
        </div>
    </div>
</div>
