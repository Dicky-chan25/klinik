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
    
    @include('dashboard.care_patient.component.obat_nonracik.header')
    @include('dashboard.care_patient.component.obat_nonracik.body')
    
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
                $("#save-onr").click();
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

    let onrList = [];
    let code = "";
    let codeMdc = "";
    let medName = "";
    let exp = "";
    let stockout = "";
    let ppu = "";
    let title = "";
    let nameCat = "";
    let qty = "";
    let totalPrice = "";
    let rule = "";
    let ruleText = "";

    $(document).ready(function() {
        $('#alertSuccess').css('display', 'none')
        $('#alertError').css('display', 'none')
        loadDataObatNonRacik();
        loadTableObatNonRacik();
    });

    function loadDataObatNonRacik() {
        fetch('/obat-non-racik')
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let dataResult = data;
            dataResult.map(function(data) {
                $("#tableOnr").append(`
                <tr>
                    <td>${data.code}</td>
                    <td>${data.codeMdc}</td>
                    <td>${data.medName}</td>
                    <td>${data.exp}</td>
                    <td>${data.stockout}</td>
                    <td>${data.ppu}</td>
                    <td>${data.title}</td>
                    <td>${data.nameCat}</td>
                    <td>
                        <button id='select-onr'
                        class="btn btn-primary btn-sm"
                        data-dismiss="modal"
                        data-code="${data.code}"
                        data-codemdc="${data.codeMdc}"
                        data-medname="${data.medName}"
                        data-exp="${data.exp}"
                        data-stockout="${data.stockout}"
                        data-ppu="${data.ppu}"
                        data-title="${data.title}"
                        data-namecat="${data.nameCat}"
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

    function loadTableObatNonRacik() {
        $("#tableItemOnr").empty();
        onrList.map(function(data, index){
            $('#tableItemOnr').append(`
            <tr>
                <td>
                    <input style="display:none" type="text" name="onr[${index}][codeMdc]" value="${data.code}">
                    ${data.codeMdc}
                </td>
                <td>
                    ${data.medName}
                </td>
                <td>
                    ${data.exp}
                </td>
                <td>
                    <input style="display:none" type="text" name="onr[${index}][price]" value="${data.ppu}">
                    ${data.ppu}
                </td>
                <td>
                    <input style="display:none" type="text" name="onr[${index}][qty]" value="${data.qty}">
                    ${data.qty}
                </td>
                <td>
                    ${data.title}
                </td>
                <td>
                    <input style="display:none" type="text" name="onr[${index}][rule]" value="${data.rule}">
                    ${data.rule}
                </td>
                <td>
                    <input style="display:none" type="text" name="onr[${index}][total_price]" value="${data.totalPrice}">
                    ${data.totalPrice}
                </td>
                <td>
                    <button class="btn btn-sm btn-danger tableOnrDelete"
                    data-index="${index}"
                    >
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            `)
        })
    }


    $(document).on('click', ".tableOnrDelete", function() {
        var index = $(this).data("index");
        onrList.splice(index,1);
        loadTableObatNonRacik();
    })
   

     // on click passing data to form
    $(document).on('click', "#add-item-onr", function() {
        var qty = $('#qty').val();
        var rule = $("select#rule option").filter(":selected").val();
        console.log(code, codeMdc, qty, rule);
        if (code == '' || codeMdc == '' || medName == '' || exp == '' || stockout == '' || ppu == '' || title == '' || nameCat == '' ||qty == '' ||rule == '') {
            $('#alertError').text("Anda belum melengkapi form dibawah");
            $('#alertError').css('display', 'block')
        } else {
            $('#alertSuccess').text("Berhasil Menambahkan Obat Non Racikan");
            $('#alertSuccess').css('display', 'block')
            let obj = { 
                'code' : code, 
                'codeMdc' : codeMdc,
                'medName' : medName,
                'exp' : exp,
                'stockout' : stockout,
                'ppu' : ppu,
                'title' : title,
                'nameCat' : nameCat,
                'qty' : qty,
                'rule' : rule,
                'totalPrice' : totalPrice,
            };
            onrList.push(obj);
            // console.log(onrList);
            loadTableObatNonRacik();
            var total = 0;
            for (var i = 0; i < onrList.length; i++) {
                total += onrList[i].totalPrice;
            }
            $("#totalAllPrice").text(total)
        }
        setTimeout(function (){
            $('#alertError').css('display', 'none')
            $('#alertSuccess').css('display', 'none')
        }, 5000);
    })

    $(document).on('click', "#select-onr", function() {
        
        code = $(this).data("code");
        codeMdc = $(this).data("codemdc");
        medName = $(this).data("medname");
        exp = $(this).data("exp");
        stockout = $(this).data("stockout");
        ppu = $(this).data("ppu");
        title = $(this).data("title");
        nameCat = $(this).data("namecat");

        $(".code").text(code)
        $(".codeMdc").text(codeMdc)
        $(".medName").text(medName)
        $(".exp").text(exp)
        $(".stockout").text(stockout)
        $(".ppu").text(ppu)
        $(".title").text(title)
        $(".nameCat").text(nameCat)

        // window.location.href = `/rawatpasien/assesment/${{!! $id !!}}/${code}/${title}`
    });

    
    const qtyItem = document.getElementById('qty');
    qtyItem.addEventListener("keyup", (e) => {
        // console.log(e.target.value);
        qty = e.target.value;
        totalPrice = qty * ppu;
        $(".totalPrice").text(totalPrice)

    }, false);

</script>
@endsection