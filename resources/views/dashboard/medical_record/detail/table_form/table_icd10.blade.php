<div class="alert alert-success m-4" id="icd10MsgSuccess"></div>
<div class="alert alert-danger m-4" id="icd10MsgError"></div>
<table class="table table-sm table-bordered icd10-item-head">
    <form action="{{route('icd-10-post', ['rmId' => $id])}}" method="POST" id="icd10Create">
        @csrf
        <thead class="bg-dark text-light">
            <tr>
                <th scope="col" class="text-center">Code</th>
                <th scope="col" class="text-center">ICD-10 Description</th>
                <th scope="col" class="text-center">CoD</th>
                <th scope="col" class="text-center">Jenis</th>
                <th scope="col" class="text-center">
                    <button id="submit10" type="submit" class="btn btn-primary btn-sm text-light"><i class="fas fa-check"></i></button>
                    <div id="add10" class="btn btn-info btn-sm text-light"><i class="fas fa-plus"></i></div>
                </th>
            </tr>
        </thead>
        <tbody id="table10">
            <tr>
                <td style="max-width:80px">
                    <input type="text" class="form-control codeicd10" disabled>
                    
                </td>
                <td style="width:22rem !important">
                    <select style="width:22rem !important" class="form-control" 
                    id="selectIcd10" name="icd10_diagnose"></select>
                </td>
                <td>
                    <select class="form-control" name="icd10_is_new">
                        <option value="0">Baru</option>
                        <option value="1">Lama</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="icd10_category">
                        <option value="0">Diagnosa Primer</option>
                        <option value="1">Diagnosa Sekunder</option>
                    </select>
                </td>
                <td class="text-center" style="width:100px">
                    <div class="m-1">
                        <div id="remove10" class="btn btn-danger btn-sm text-light"><i
                                class="fas fa-trash"></i></div>
                    </div>
                </td>
            </tr>
        </tbody>
    </form>
    <p id="icd10Loading"></p>
    <tbody id="table10Res"></tbody>
</table>



