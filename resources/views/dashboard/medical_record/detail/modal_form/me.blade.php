<!-- Modal -->
<div class="modal fade" id="meOnline">
    <div class="modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Permintaan Alat Kesehatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success m-4" id="meMsgSuccess"></div>
            <div class="alert alert-danger m-4" id="meMsgError"></div>
            <form action="{{ route('me-post', ['rmId' => $id]) }}" method="POST" id="meCreate">
                <div class="modal-body" id="modal-bill-data" style="max-height: 40rem;overflow-auto">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Dokter Pengirim</label>
                                <div class="form-control">{{ Auth::user()->username }}</div>
                                <input style="display:none" type="text" disabled name="reffering_dr"
                                    value="{{ Auth::user()->username }}">
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
                                <label for="">Dokter Alkes</label>
                                <select style="width:100%" class="form-control" id="selectMeDr" name="me_dr"></select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tanggal Periksa</label>
                                <input type="datetime-local" value="" class="form-control" name="checked_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Catatan</label>
                        <textarea name="info" id="info" class="form-control" rows="4"></textarea>
                    </div>
                    <livewire:check-box-medic-equip />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Buat Permintaan</button>
                </div>
            </form>
        </div>
    </div>
</div>