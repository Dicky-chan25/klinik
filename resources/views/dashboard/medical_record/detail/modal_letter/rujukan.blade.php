<!-- Modal -->
<div class="modal fade" id="rujukanLetter">
    <div class="modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Surat Rujukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('me-post', ['rmId' => $id]) }}" method="POST" id="meCreate">
                <div class="modal-body" id="modal-bill-data" style="max-height: 40rem;overflow-auto">
                    @csrf
                    <div class="form-group">
                        <label for="rs">Dokter</label>
                        <input type="text" name="" id="" class="form-control" disabled value="Dr. asep">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="dear">Kepada</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="rs">Rumah Sakit</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="rs">Sebab Dirujuk</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Fasilitas yang dibutuhkan</label>
                                <select name="" id="" class="form-control">
                                    <option value="">ICU</option>
                                    <option value="">ICCU</option>
                                    <option value="">HCU</option>
                                    <option value="">IMC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <textarea style="resize: none" name="note"
                        type="text" class="form-control" id="note" 
                        placeholder="catatan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan & Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
