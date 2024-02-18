 <!-- Modal -->
 <div class="modal fade radioOnline" id="radioOnline">
    <div class="modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Permintaan Radiologi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success m-4" id="radioMsgSuccess"></div>
            <div class="alert alert-danger m-4" id="radioMsgError"></div>
            <form action="{{route('radio-post', ['rmId' => $id])}}" method="POST" id="radioCreate">
                <div class="modal-body" id="modal-bill-data" style="max-height: 40rem;overflow-auto">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Dokter Pengirim</label>
                                <div class="form-control">{{Auth::user()->username}}</div>
                                <input style="display:none" type="text" name="reffering_dr" value="{{Auth::user()->id}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Diagnosis Klinis</label>
                                <input type="text" value="" class="form-control" name="diagnosis">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Dokter Radiologi</label>
                                <select style="width:100%" class="form-control" id="selectRadioDr" name="radio_dr"></select>
                            </div>
                        </div>
                        <div class="col-lg-6">                            
                            <div class="form-group">
                                <label for="">Tanggal Periksa Radiologi</label>
                                <input type="datetime-local" value="" class="form-control" name="checked_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Catatan</label>
                        <textarea name="info" id="info" class="form-control" rows="4"></textarea>
                    </div>
                    <livewire:check-box-radio/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Buat Permintaan</button>
                </div>
            </form>
        </div>
    </div>
</div>