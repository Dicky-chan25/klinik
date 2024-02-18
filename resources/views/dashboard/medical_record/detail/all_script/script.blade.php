{{-- Multi Row Table Prescript --}}
<script>
    $(document).ready(function() {
        loadDataPre();
        loadDataLab();
        loadDataRadio();
        loadDataMe();
        loadDataIcd10();
        loadDataIcd9();
        loadDataCppt();
    });
    $(document).on('click', '#removePre', function() {
        $(this).parents('tr').remove();
    })
    // $(document).on('click', '#removeLab', function() {
    //     $(this).parents('tr').remove();
    // })
    // $(document).on('click', '#removeRadio', function() {
    //     $(this).parents('tr').remove();
    // })
    // $(document).on('click', '#removeMe', function() {
    //     $(this).parents('tr').remove();
    // })
</script>

{{-- Multi Row Table CPPT --}}
<script>
    $('.cpptMsgSuccess').css('display', 'none')
    $('.cpptMsgError').css('display', 'none')
    $("#tableCppt").hide();
    $("#submitCppt").hide();

    $("#addCppt").on('click', function(){
        $("#submitCppt").show();
        $("#tableCppt").show();
    });
    $("#removeCppt").on('click', function(){
        $("#submitCppt").hide();
        $("#tableCppt").hide();
    });
    // submit cppt
    $("#cpptCreate").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        console.log('formdata', formData);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#cpptLoading').html('Loading.....');
            },
            error: function(response) {
                console.log('error', response);
            },
            success: function(response) {
                if (response.statusCode == 201 || response.statusCode == 200) {
                    $('.cpptMsgSuccess').text(response.message);
                    $('.cpptMsgSuccess').css('display', 'block')
                } else {
                    $('.cpptMsgError').text(response.message);
                    $('.cpptMsgError').css('display', 'block')
                }
                $('#cpptLoading').css('display', 'none');
                $("#tableCpptRes").remove();
                $('#cpptOnline').modal('hide');
                $(".cppt-item-head").append(`<tbody id="tableCpptRes"></tbody>`)
                loadDataCppt();
                setTimeout(function (){
                    $('.cpptMsgSuccess').css('display', 'none')
                    $('.cpptMsgError').css('display', 'none')
                }, 5000);
            },
        });
    });
    // Load Table IcdCPPT
    function loadDataCppt() {
        fetch('/cppt/' + {!! $id !!})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let dataResult = data;
            dataResult.map(function(data) {
                $("#tableCpptRes").append(`
                <tr>
                    <td style="width:70px !important;">${data.createdAt}</td>
                    <td style="width:100px !important;">${data.code}</td>
                    <td style="width:70px !important;">${data.username}</td>
                    <td style="width:70px !important;">${data.doctor}</td>
                    <td style="width:40px !important;" class="text-center">
                        <a class="btn btn-primary btn-sm ml-2" href="#" data-target="#cpptItem" data-toggle="modal">
                            <i class="fas fa-list"></i>
                        </a>
                        <a class="btn btn-danger btn-sm ml-2" href="#" data-target="#cpptItem" data-toggle="modal">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                `)
            })
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>

{{-- Multi Row Table ICD 10 --}}
<script>
    $('#icd10MsgSuccess').css('display', 'none')
    $('#icd10MsgError').css('display', 'none')
    $("#table10").hide();
    $("#submit10").hide();
    $("#add10").on('click', function(){
        $("#submit10").show();
        $("#table10").show();
    });
    $("#remove10").on('click', function(){
        $("#submit10").hide();
        $("#table10").hide();
    });
    // select2 Icd10
    $("#selectIcd10").on('select2:select', function (e) {
        $('.codeicd10').val(e.params.data.code)
    });
    $("#selectIcd10").select2({
        placeholder:'Pilih ICD 10',
        theme: 'bootstrap-5',
        ajax: {
            url: "{{route('icd-10-load')}}",
            dataType: 'json',
            data: function(term) {
                return term;
            },
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            id: item.id,
                            text: item.title,
                            code: item.code
                        }
                    })
                }
            }
        }
    })
    // submit Icd10
    $("#icd10Create").submit(function(e) {
        console.log('asdasd');
        e.preventDefault();
        let formData = new FormData(this);
        console.log('formdata', formData);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#icd10Loading').html('Loading.....');
            },
            error: function(response) {
                console.log('error', response);
            },
            success: function(response) {
                if (response.statusCode == 201 || response.statusCode == 200) {
                    $('#icd10MsgSuccess').text(response.message);
                    $('#icd10MsgSuccess').css('display', 'block')
                } else {
                    $('#icd10MsgError').text(response.message);
                    $('#icd10MsgError').css('display', 'block')
                }
                $('#icd10Loading').css('display', 'none');
                $("#table10Res").remove();
                $(".icd10-item-head").append(`<tbody id="table10Res"></tbody>`)
                loadDataIcd10();
                setTimeout(function (){
                    $('#icd10MsgSuccess').css('display', 'none')
                    $('#icd10MsgError').css('display', 'none')
                }, 5000);
            },
        });
    });
    // Load Table Icd10
    function loadDataIcd10() {
        fetch('/icd_10/' + {!! $id !!})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let dataResult = data;
            dataResult.map(function(data) {
                $("#table10Res").append(`
                <tr>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.code}">
                    </td>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.title}">
                    </td>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.cod == 1 ? 'Baru' : data.cod == 2 ? 'Lama' : ''}">
                    </td>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.diagnose_cat == 1 ? 'Primer' : data.diagnose_cat == 2 ? 'Sekunder' : ''}">
                    </td>
                    <td class="text-center" style="max-width:80px">
                        <div class="m-1">
                            <div class="btn btn-danger btn-sm text-light"><i
                                    class="fas fa-trash"></i></div>
                        </div>
                    </td>
                </tr>
                `)
            })
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>

{{-- Multi Row Table ICD 9 --}}
<script>
    $('#icd9MsgSuccess').css('display', 'none')
    $('#icd9MsgError').css('display', 'none')
    $("#table9").hide();
    $("#submit9").hide();
    $("#add9").on('click', function(){
        $("#submit9").show();
        $("#table9").show();
    });
    $("#remove9").on('click', function(){
        $("#submit9").hide();
        $("#table9").hide();
    });
    // select2 Icd9
    $("#selectIcd9").on('select2:select', function (e) {
        $('.codeicd9').val(e.params.data.code)
    });
    $("#selectIcd9").select2({
        placeholder:'Pilih ICD 9',
        theme: 'bootstrap-5',
        ajax: {
            url: "{{route('icd-9-load')}}",
            dataType: 'json',
            data: function(term) {
                return term;
            },
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            id: item.id,
                            text: item.title,
                            code: item.code
                        }
                    })
                }
            }
        }
    })
    // submit Icd9
    $("#icd9Create").submit(function(e) {;
        e.preventDefault();
        let formData = new FormData(this);
        console.log('formdata', formData);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#icd9Loading').html('Loading.....');
            },
            error: function(response) {
                console.log('error', response);
            },
            success: function(response) {
                if (response.statusCode == 201 || response.statusCode == 200) {
                    $('#icd9MsgSuccess').text(response.message);
                    $('#icd9MsgSuccess').css('display', 'block')
                } else {
                    $('#icd9MsgError').text(response.message);
                    $('#icd9MsgError').css('display', 'block')
                }
                $('#icd9Loading').css('display', 'none');
                $("#table9Res").remove();
                $(".icd9-item-head").append(`<tbody id="table9Res"></tbody>`)
                loadDataIcd9();
                setTimeout(function (){
                    $('#icd9MsgSuccess').css('display', 'none')
                    $('#icd9MsgError').css('display', 'none')
                }, 5000);
            },
        });
    });
    // Load Table Icd9
    function loadDataIcd9() {
        fetch('/icd_9/' + {!! $id !!})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let dataResult = data;
            dataResult.map(function(data) {
                $("#table9Res").append(`
                <tr>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.code}">
                    </td>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.title}">
                    </td>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.cod == 1 ? 'Baru' : data.cod == 2 ? 'Lama' : ''}">
                    </td>
                    <td style="max-width:80px">
                        <input type="text" class="form-control" disabled value="${data.diagnose_cat == 1 ? 'Primer' : data.diagnose_cat == 2 ? 'Sekunder' : ''}">
                    </td>
                    <td class="text-center" style="max-width:80px">
                        <div class="m-1">
                            <div class="btn btn-danger btn-sm text-light"><i
                                    class="fas fa-trash"></i></div>
                        </div>
                    </td>
                </tr>
                `)
            })
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>

{{-- Load Select2 Doctor --}}
<script>
    $(document).ready(function(){
        $("#selectMeDr").select2({
            placeholder:'Pilih Dokter',
            theme: 'bootstrap-5',
            ajax: {
                url: "{{route('doctor-load')}}",
                dataType: 'json',
                data: function(term) {
                    return term;
                },
                processResults: function(data){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id,
                                text: item.doctorname,
                            }
                        })
                    }
                }
            }
        })
    })
    $(document).ready(function(){
        $("#selectLabDr").select2({
            placeholder:'Pilih Dokter',
            theme: 'bootstrap-5',
            ajax: {
                url: "{{route('doctor-load')}}",
                dataType: 'json',
                data: function(term) {
                    return term;
                },
                processResults: function(data){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id,
                                text: item.doctorname,
                            }
                        })
                    }
                }
            }
        })
    })
    $(document).ready(function(){
        $("#selectRadioDr").select2({
            placeholder:'Pilih Dokter',
            theme: 'bootstrap-5',
            ajax: {
                url: "{{route('doctor-load')}}",
                dataType: 'json',
                data: function(term) {
                    return term;
                },
                processResults: function(data){
                    return {
                        results: $.map(data, function(item){
                            return {
                                id: item.id,
                                text: item.doctorname,
                            }
                        })
                    }
                }
            }
        })
    })
</script>

{{-- Load AND Create Request Prescript, Laboratory, Radiology, MedicalEquipment --}}
<script>
    $('#prescriptMsgSuccess').css('display', 'none')
    $('#prescriptMsgError').css('display', 'none')

    $('#labMsgSuccess').css('display', 'none')
    $('#labMsgError').css('display', 'none')

    $('#radioMsgSuccess').css('display', 'none')
    $('#radioMsgError').css('display', 'none')

    $('#meMsgSuccess').css('display', 'none')
    $('#meMsgError').css('display', 'none')

    function loadDataPre() {
        fetch('/prescript/' + {!! $id !!})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
                let dataResult = data;
                dataResult.map(function(data) {
                    $(".prescript-item").append(`
                    <div id="prelistitem" style="background-color:rgb(228, 141, 79);margin-bottom:2px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                    #${data.code}</div>`)
                })
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function loadDataLab() {
        fetch('/lab/' + {!! $id !!})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
                let dataResult = data;
                dataResult.map(function(data) {
                    $(".lab-item").append(`
                    <div id="labitem" style="background-color:rgb(228, 141, 79);margin-bottom:2px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                    #${data.code}</div>`)
                })
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function loadDataRadio() {
        fetch('/radio/' + {!! $id !!})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
                let dataResult = data;
                dataResult.map(function(data) {
                    $(".radio-item").append(`
                    <div id="radioitem" style="background-color:rgb(228, 141, 79);margin-bottom:2px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                    #${data.code}</div>`)
                })
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function loadDataMe() {
        fetch('/me/' + {!! $id !!})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
                let dataResult = data;
                dataResult.map(function(data) {
                    $(".me-item").append(`
                    <div id="meitem" style="background-color:rgb(228, 141, 79);margin-bottom:2px;padding-top:10px;padding-bottom:10px;border-radius:4px;color:white;text-align:center">
                    #${data.code}</div>`)
                })
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    $("#prescriptCreate").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#preLoading').html('Loading.....');
            },
            error: function(response) {
                console.log('error', response);
            },
            success: function(response) {
                
                if (response.statusCode == 201 || response.statusCode == 200) {
                    // $('#prescriptItem').text(response.message);
                    $('#prescriptMsgSuccess').text(response.message);
                    $('#prescriptMsgSuccess').css('display', 'block')
                } else {
                    $('#prescriptMsgError').text(response.message);
                    $('#prescriptMsgError').css('display', 'block')
                }
                $('#resepOnline').modal('hide');
                $('#preLoading').css('display', 'none');
                $(".prescript-item").remove();
                $(".prescript-item-head").append(`<div class="prescript-item"></div>`)
                loadDataPre();
                setTimeout(function (){
                    $('#prescriptMsgSuccess').css('display', 'none')
                    $('#prescriptMsgError').css('display', 'none')
                }, 5000);
            },
        });
    });

    $("#labCreate").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#labLoading').html('Loading.....');
            },
            error: function(response) {
                console.log('error', response);
            },
            success: function(response) {
                
                if (response.statusCode == 201 || response.statusCode == 200) {
                    $('#labMsgSuccess').text(response.message);
                    $('#labMsgSuccess').css('display', 'block')
                } else {
                    $('#labMsgError').text(response.message);
                    $('#labMsgError').css('display', 'block')
                }
                $('#labOnline').modal('hide');
                $('#labLoading').css('display', 'none');
                $(".lab-item").remove();
                $(".lab-item-head").append(`<div class="lab-item"></div>`)
                loadDataLab();
                setTimeout(function (){
                    $('#labMsgSuccess').css('display', 'none')
                    $('#labMsgError').css('display', 'none')
                }, 5000);
            },
        });
    });
    
    $("#radioCreate").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#radioLoading').html('Loading.....');
            },
            error: function(response) {
                console.log('error', response);
            },
            success: function(response) {
                
                if (response.statusCode == 201 || response.statusCode == 200) {
                    $('#radioMsgSuccess').text(response.message);
                    $('#radioMsgSuccess').css('display', 'block')
                } else {
                    $('#radioMsgError').text(response.message);
                    $('#radioMsgError').css('display', 'block')
                }
                $('#radioOnline').modal('hide');
                $('#radioLoading').css('display', 'none');
                $(".radio-item").remove();
                $(".radio-item-head").append(`<div class="radio-item"></div>`)
                loadDataRadio();
                setTimeout(function (){
                    $('#radioMsgSuccess').css('display', 'none')
                    $('#radioMsgError').css('display', 'none')
                }, 5000);
            },
        });
    });

    $("#meCreate").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#meLoading').html('Loading.....');
            },
            error: function(response) {
                console.log('error', response);
            },
            success: function(response) {
                
                if (response.statusCode == 201 || response.statusCode == 200) {
                    $('#meMsgSuccess').text(response.message);
                    $('#meMsgSuccess').css('display', 'block')
                } else {
                    $('#meMsgError').text(response.message);
                    $('#meMsgError').css('display', 'block')
                }
                $('#meOnline').modal('hide');
                $('#meLoading').css('display', 'none');
                $(".me-item").remove();
                $(".me-item-head").append(`<div class="me-item"></div>`)
                loadDataMe();
                setTimeout(function (){
                    $('#meMsgSuccess').css('display', 'none')
                    $('#meMsgError').css('display', 'none')
                }, 5000);
            },
        });
    });

</script>
