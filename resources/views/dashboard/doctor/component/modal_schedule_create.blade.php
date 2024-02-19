 <!-- Modal -->
 <div class="modal fade" id="scModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jadwal Praktek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{route('dokter-schedule-create', ['id' => $detailData->id ])}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="day">Pilih Hari</label>
                    <select class="form-control" name="day" id="day">
                        <option value="" disabled selected>Pilih</option>
                        @foreach ($days as $dy)
                            <option value="{{$dy->id}}">{{$dy->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="firstTime">Waktu Awal</label>
                    <input class="form-control" type="time" name="firstTime" id="firstTime">
                </div>
                <div class="form-group">
                    <label for="endTime">Waktu Akhir</label>
                    <input class="form-control" type="time" name="endTime" id="endTime">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary submit-delete">Tambah</button>
            </div>
        </form>
    </div>
    </div>
</div>