 <!-- Modal -->
 <div class="modal fade" id="resepOnline">
    <div class="modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Buat Resep Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success m-4" id="prescriptMsgSuccess"></div>
            <div class="alert alert-danger m-4" id="prescriptMsgError"></div>
            <form action="{{route('prescript-post', ['rmId' => $id])}}" method="POST" id="prescriptCreate">
                <div class="modal-body" id="modal-bill-data">
                    @csrf
                    <livewire:dropdown-prescription/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Resep</button>
                </div>
            </form>
        </div>
    </div>
</div>
