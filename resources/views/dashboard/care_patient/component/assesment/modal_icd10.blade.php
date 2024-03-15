 <!-- Modal -->
 <div class="modal fade" id="icd10Data">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Data ICD-10</h5>
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
                                <th>Kode ICD</th>
                                <th>Diagnosa ICD 10</th>
                                <th>Deskripsi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="tableicd10"></tbody>
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

@section('script')
    
<script>
    $(document).ready(function() {
        loadDataIcd10();
    });

    function loadDataIcd10() {
        fetch('/icd_10')
        .then((response) => {
            console.log("response");
            console.log(response);
            return response.json();
        })
        .then((data) => {
            let dataResult = data;
            dataResult.map(function(data) {
                $("#tableicd10").append(`
                <tr>
                    <td>${data.code}</td>
                    <td>${data.title}</td>
                    <td>${data.desc}</td>
                    <td>
                        <button id='select-icd10'
                        class="btn btn-primary btn-sm select-icd10"
                        data-dismiss="modal"
                        data-code="${data.code}" 
                        data-title="${data.title}" 
                        data-desc="${data.desc}" 
                        >Pilih</button>
                    </td>
                </tr>
                `)
            })
        })
        .catch(function(error) {
            console.log(error);
        });
    }

     // on click passing data to form
    $(document).on('click', "#select-icd10", function() {
        var code = $(this).data("code");
        var title = $(this).data("title");
        var desc = $(this).data("desc");
        console.log(code, title, desc);
        window.location.href = `/rawatpasien/assesment/${{!! $id !!}}/${code}/${title}`
    });
</script>
@endsection