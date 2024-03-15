 <!-- Modal -->
 <div class="modal fade" id="obatRacikData">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Data Obat Racik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            {{-- <div class="col-lg-6 input-group">
                <input type="text" class="form-control" id="inputIcd10" placeholder="Cari Kode ICD-10">
                <span class="input-group-text" id="basic-addon2">
                        <i class="fa fa-search"></i>
                </span>
            </div> --}}
            <div class="col-lg-12">
                <div class="table table-bordered my-4 table-responsive">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Obat</th>
                                <th>Harga</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="tableOr"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>

