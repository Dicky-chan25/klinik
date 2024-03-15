 {{-- <!-- Modal -->
 <div class="modal fade" id="editData">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Filter Data</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form method="POST" accept="{{route('obatmasuk-edit' )}}">
                @csrf
                <div class="modal-body">
                    <input type="number" style="display: block" class="editId">
                    <div class="form-group">
                        <label for="fromDate">Nama Obat</label>
                        <livewire:dropdown-medicine>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Nama Supplier</label>
                        <input name="supplier" type="text" class="form-control" id="supplier" placeholder="supplier">
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input name="qty" type="text" class="form-control" id="qty" placeholder="qty">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
             </form>
         </div>
     </div>
 </div> --}}
