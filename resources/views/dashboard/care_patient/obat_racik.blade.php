@extends('dashboard-layout.main')

@section('dashboard')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Perawatan Pasien</h1>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            <span class="text-sm">{{Session::get('success')}}</span>
        </div>
    @endif
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if ($err = Session::get('err'))
        <div class="alert alert-danger" role="alert">
            <span class="text-sm">{{ $err }}</span>
        </div>
    @endif
    
    @include('dashboard.care_patient.component.obat_racik.header')
    @include('dashboard.care_patient.component.obat_racik.body')
    
@endsection
@section('script')
<script>
    document.getElementById('b4').onclick = function(){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, save it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $("#save-or").click();
                // swalWithBootstrapButtons.fire({
                //     title: "Successed!",
                //     text: "Data has been saved",
                //     icon: "success"
                // });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Data is not saved",
                    icon: "error"
                });
        }
        });
    };
</script>
<script>

    let orList = [];
    let id = "";
    let code = "";
    let medName = "";
    let price = "";
    let totalPrice = "";
    let rule = "";
    let ruleText = "";

    $(document).ready(function() {
        $('#alertSuccess').css('display', 'none')
        $('#alertError').css('display', 'none')
        loadDataObatRacik();
        loadTableObatRacik();
    });

    function loadDataObatRacik() {
        fetch('/obat-racik')
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let dataResult = data;
            dataResult.map(function(data) {
                $("#tableOr").append(`
                <tr>
                    <td>${data.code}</td>
                    <td>${data.medName}</td>
                    <td>${data.price}</td>
                    <td>
                        <button id='select-or'
                        class="btn btn-primary btn-sm"
                        data-dismiss="modal"
                        data-dataid="${data.medId}"
                        data-code="${data.code}"
                        data-medname="${data.medName}"
                        data-price="${data.price}"
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

    function loadTableObatRacik() {
        $("#tableItemOr").empty();
        orList.map(function(data, index){
            $('#tableItemOr').append(`
            <tr>
                <td>
                    <input style="display:none" type="text" name="or[${index}][code]" value="${data.code}">
                    ${data.code}
                </td>
                <td>
                    <input style="display:none" type="text" name="or[${index}][name]" value="${data.medName}">
                    ${data.medName}
                </td>
                <td>
                    <input style="display:none" type="text" name="or[${index}][price]" value="${data.price}">
                    ${data.price}
                </td>
                <td>
                    <input style="display:none" type="text" name="or[${index}][rule]" value="${data.rule}">
                    ${data.rule}
                </td>
                <td>
                    <button class="btn btn-sm btn-danger tableOrDelete" data-index="${index}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            `)
        })
    }


    $(document).on('click', ".tableOrDelete", function() {
        var index = $(this).data("index");
        orList.splice(index,1);
        loadTableObatRacik();
    })
   

     // on click passing data to form
    $(document).on('click', "#add-item-or", function() {
        // var qty = $('#qty').val();
        var rule = $("select#rule option").filter(":selected").val();
        console.log(code, rule);
        if (code == '' || medName == '' || price == '' ||rule == '') {
            $('#alertError').text("Anda belum melengkapi form dibawah");
            $('#alertError').css('display', 'block')
        } else {
            $('#alertSuccess').text("Berhasil Menambahkan Obat Non Racikan");
            $('#alertSuccess').css('display', 'block')
            let obj = { 
                'code' : code, 
                'price' : price,
                'medName' : medName,
                'rule' : rule,
            };
            orList.push(obj);
            console.log(orList);
            loadTableObatRacik();
            var total = 0;
            for (var i = 0; i < orList.length; i++) {
                total += orList[i].price;
            }
            $("#totalAllPrice").text(total)
        }
        setTimeout(function (){
            $('#alertError').css('display', 'none')
            $('#alertSuccess').css('display', 'none')
        }, 5000);
    })

    $(document).on('click', "#select-or", function() {
        
        id = $(this).data("dataid");
        code = $(this).data("code");
        medName = $(this).data("medname");
        price = $(this).data("price");

        $(".code").text(code)
        $(".medName").text(medName)
        $(".price").text(price)

        // window.location.href = `/rawatpasien/assesment/${{!! $id !!}}/${code}/${title}`
    });

    
    // const qtyItem = document.getElementById('qty');
    // qtyItem.addEventListener("keyup", (e) => {
    //     // console.log(e.target.value);
    //     qty = e.target.value;
    //     totalPrice = qty * ppu;
    //     $(".totalPrice").text(totalPrice)

    // }, false);

</script>
@endsection