 <!-- Modal -->
 <div class="modal fade" id="filterUser">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Filter Data</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form>
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="fromDate">Dari Tanggal</label>
                         <input name="fromDate" type="date" class="form-control" id="fromDate"
                             placeholder="fromDate">
                     </div>
                     <div class="form-group">
                         <label for="toDate">Sampai Tanggal</label>
                         <input name="toDate" type="date" class="form-control" id="toDate" placeholder="toDate">
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
