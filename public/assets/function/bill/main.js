// function to get data event from database
function getBill(month, year) {
    $.ajax({
        type: "get",
        url: "bill/render/"+month+'/'+year,
        dataType: "json",
        success: function (response) {
            $(".table-render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function getAdditional(month, year) {
    $.ajax({
        type: "get",
        url: "bill/additional/"+month+'/'+year,
        dataType: "json",
        success: function (response) {
            $('.total-transaction').empty().append(response.total_transaction)
            $('.transaction-success').empty().append(response.transaction_success)
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    
    let date = new Date();
    let month = date.getMonth()+1;
    let year = date.getFullYear();

    $('#month').val(month);
    $('#year').val(year);

    // call perform
    getBill(month, year);
    getAdditional(month, year);

    $("body").on("change", '#month, #year', function (e) {
        let month = $('select[name=month]').find('option:selected').val();
        let year = $('select[name=year]').find('option:selected').val();
        
        getBill(month, year)
        getAdditional(month, year);
    });

    $('body').on('click', '.btn-validate', function () {
        var bill_id = $(this).data('id');
        let month = $('select[name=month]').find('option:selected').val();
        let year = $('select[name=year]').find('option:selected').val();
        Swal.fire({
            icon: 'warning',
            // icon: 'error',
            title: "Validasi pembayaran?",
            text: 'validasi data',
            showCancelButton: true,
            confirmButtonText: "Proses",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $.ajax({
                            type: "POST",
                            url: "bill/validate",
                            data: {
                                id: bill_id
                            },
                        })
                        .done(function (response) {
                            // toastr[response.status](response.message, response.title);
                            getBill(month, year)
                            getAdditional(month, year);
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            );
                        })
                        .fail(function () {
                            // toastr[response.status](response.message, response.title);
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            );
                        });
                });
            },
            allowOutsideClick: false,
        });
    });

    // on submit form
    $('body').on('click', '.btn-save', function (e) {
        let month = $('select[name=month]').find('option:selected').val();
        let year = $('select[name=year]').find('option:selected').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formBill')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "bill/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-save').attr('disable', 'disabled')
                $('.btn-save').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-save').removeAttr('disable')
                $('.btn-save').html('Save')
            },
            success: function (response) {
                toastr[response.status](response.message, response.title);
                $('#form-bill').trigger('reset');
                getBill(month, year);
                getAdditional(month, year);
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    function convertDateDBtoIndo(string) {
        bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
    
        tanggal = string.split("-")[2];
        bulan = string.split("-")[1];
        tahun = string.split("-")[0];
    
        return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
    }

    // print
    $('body').on('click', '.btn-print', function(){
        let id = $(this).data('id');
        let name = $(this).data('name');
        let date = $(this).data('date');

        var mode = "iframe"; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close,
            popTitle: 'Sistem Informasi Eksekutif Koperasi Lumbung Sedana'
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "bill/print",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                document.title= 'Invoice - ' + name + '-' + convertDateDBtoIndo(date)
                $(response.data).find("div.printableArea").printArea(options);
            }
        });
    });
});