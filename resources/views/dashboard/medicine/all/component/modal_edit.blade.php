 <!-- Modal -->
 <div class="modal fade" id="editUser">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Edit Data</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form method="POST" action="{{route('semuaobat-edit', ['id' => $item->medId])}}" >
                @csrf
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="mname">Ubah Nama Obat</label>
                         <input value="{{$item->medName}}" name="mname" value="mname" type="text" class="form-control" id="mname"
                             placeholder="mname">
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
