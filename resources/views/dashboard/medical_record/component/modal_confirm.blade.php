 <!-- Modal -->
 <div class="modal fade" id="confirmData">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Data Akan Dikunci</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" id="modal-bill-data">
            <p>Dengan Anda melakukan submit, maka data rekam medis, resep obat dan pemeriksaan lanjutan tidak dapat di ubah / ditambahkan, setelah itu akan diterbitkan nota pembayaran tagihan, Lanjutkan ? </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="{{route('rekammedis-detail-submit', ['id' => $idMr])}}" class="btn btn-danger">Submit Data</a>
        </div>
    </div>
    </div>
</div>