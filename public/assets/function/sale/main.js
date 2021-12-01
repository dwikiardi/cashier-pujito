function getSale() {
    $.ajax({
        type: "get",
        url: "/admin/sale/render",
        dataType: "json",
        success: function (response) {
            $(".data-rendered").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function toRupiah(number)
{
    reverse = number.toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
	ribuan	= ribuan.join('.').split('').reverse().join('');

    return "Rp. " + ribuan;
}

$(document).ready(function () {
    getSale();

    $('body').on('click', '.btn-add', function(){
        $('#modalAddData').modal('show');
    });

    // on save button
    $('body').on('click', '.btn-save', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formAddData')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/admin/sale/store",
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
                $('.btn-save').html('Simpan')
            },
            success: function (response) {
                toastr[response.status](response.message, response.title);
                $('#formAddData').trigger('reset')
                $("#modalAddData").modal("hide");
                $(".invalid-feedback").html('')
                getSale();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.discount) {
                            $('#discount').addClass('is-invalid')
                            $('#discount').trigger('focus')
                            $('.error-discount').html(error.responseJSON.errors.discount)
                        } else {
                            $('#discount').removeClass('is-invalid')
                            $('.error-discount').html('')
                        }
                        if (error.responseJSON.errors.total) {
                            $('#total').addClass('is-invalid')
                            $('#total').trigger('focus')
                            $('.error-total').html(error.responseJSON.errors.total)
                        } else {
                            $('#total').removeClass('is-invalid')
                            $('.error-total').html('')
                        }
                        if (error.responseJSON.errors.sale_date) {
                            $('#saleDate').addClass('is-invalid')
                            $('#saleDate').trigger('focus')
                            $('.error-sale-date').html(error.responseJSON.errors.sale_date)
                        } else {
                            $('#saleDate').removeClass('is-invalid')
                            $('.error-sale-date').html('')
                        }
                    }
                }
            }
        });
    });

    // btn edit
    $('body').on('click', '.btn-edit', function () {
        let ticket_id = $(this).data('id');
        $('#modalEditData').modal('show');

        $.get("/admin/sale/edit/"+ticket_id, function (data) {
            $('#modalEditData .modal-title').text('Edit Penjualan ' + data.ticket.title)
            $('#saleId').val(data.id)
            $('#editTicketId').val(data.ticket.id)
            $('#editSaleDate').val(data.sale_date)
            $('#editDiscount').val(data.discount)
            $('#editTotalDiscount').val(toRupiah(data.ticket.price*(data.discount/100)))
        });
    });

    // on update button
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formEditData')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/admin/sale/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-update').attr('disable', 'disabled')
                $('.btn-update').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-update').removeAttr('disable')
                $('.btn-update').html('Simpan')
            },
            success: function (response) {
                toastr[response.status](response.message, response.title);
                $("#modalEditData").modal("hide");
                $(".invalid-feedback").html('')
                getSale();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.discount) {
                            $('#editDiscount').addClass('is-invalid')
                            $('#editDiscount').trigger('focus')
                            $('.error-edit-discount').html(error.responseJSON.errors.discount)
                        } else {
                            $('#editDiscount').removeClass('is-invalid')
                            $('.error-edit-discount').html('')
                        }
                        if (error.responseJSON.errors.total) {
                            $('#editTotal').addClass('is-invalid')
                            $('#editTotal').trigger('focus')
                            $('.error-edit-total').html(error.responseJSON.errors.total)
                        } else {
                            $('#editTotal').removeClass('is-invalid')
                            $('.error-edit-total').html('')
                        }
                        if (error.responseJSON.errors.sale_date) {
                            $('#editSaleDate').addClass('is-invalid')
                            $('#editSaleDate').trigger('focus')
                            $('.error-edit-sale-date').html(error.responseJSON.errors.sale_date)
                        } else {
                            $('#editSaleDate').removeClass('is-invalid')
                            $('.error-edit-sale-date').html('')
                        }
                    }
                }
            }
        });
    });

    // trigger button delete
    $("body").on("click", ".btn-delete", function () {
        let id = $(this).data('id');
        Swal.fire({
            icon: 'warning',
            // icon: 'error',
            title: "Yakin ingin menghapus data ini?",
            text: 'hapus data',
            showCancelButton: true,
            confirmButtonText: "Hapus",
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
                        url: "/admin/sale/delete",
                        data: {
                            id: id,
                        },
                    })
                        .done(function (response) {
                            getSale();
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            );
                        })
                        .fail(function () {
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

    // on ticket change
    $('#ticket').on('change', function () {
        let ticketId = $(this).val();
        let discount = parseInt($('#discount').val());
        let totalTicket = parseInt($('#total').val());
        $.get("/admin/sale/ticketPrice/"+ticketId, function (data) {
            let result = (data.price * totalTicket) - ((data.price*totalTicket)*(discount/100));
            let totalDiscount = (data.price*totalTicket)*(discount/100);
            $('#totalPrice').val(toRupiah(result));
            $('#totalDiscount').val(toRupiah(totalDiscount));
            $('#description').val(data.description);
        });
    });

    // on total ticket key up
    $('#total').on('keyup', function(){
        // if($(this).val() < 1) {
        //     $(this).val(1)
        // }

        let ticketPrice = $('select[name=ticket_id]').find('option:selected').data('price');
        let discount = parseInt($('#discount').val());
        let totalTicket = parseInt($(this).val());
        let totalDiscount = (ticketPrice*totalTicket)*(discount/100);

        let result = (ticketPrice * totalTicket) - ((ticketPrice*totalTicket) * (discount/100));
        $('#totalPrice').val(toRupiah(result));
        $('#totalDiscount').val(toRupiah(totalDiscount));
    });

    // on discount key up
    $('#discount').on('keyup', function(){
        if($(this).val() < 0) {
            $(this).val(0)
        } else if($(this).val() > 100) {
            $(this).val(100)
        }

        let ticketPrice = $('select[name=ticket_id]').find('option:selected').data('price');
        let discount = parseInt($(this).val());
        let totalTicket = parseInt($('#total').val());
        let totalDiscount = (ticketPrice*totalTicket)*(discount/100);

        let result = (ticketPrice * totalTicket) - ((ticketPrice*totalTicket) * (discount/100));
        $('#totalPrice').val(toRupiah(result));
        $('#totalDiscount').val(toRupiah(totalDiscount));
    });

    // ===============================EDIT CHANGE============================= //
    // on ticket change
    $('#editTicket').on('change', function () {
        let ticketId = $(this).val();
        let discount = parseInt($('#editDiscount').val());
        $.get("/admin/sale/ticketPrice/"+ticketId, function (data) {
            let result = (data.price * 1) - ((data.price*1)*(discount/100));
            let totalDiscount = (data.price*1)*(discount/100);
            $('#editTotalPrice').val(toRupiah(result));
            $('#editTotalDiscount').val(toRupiah(totalDiscount));
            $('#editDescription').val(data.description);
        });
    });

    // on discount key up
    $('#editDiscount').on('keyup', function(){
        if($(this).val() < 0) {
            $(this).val(0)
        } else if($(this).val() > 100) {
            $(this).val(100)
        }

        let ticketPrice = $('select[name=edit_ticket_id]').find('option:selected').data('price');
        let discount = parseInt($(this).val());
        let totalDiscount = (ticketPrice*1)*(discount/100);

        let result = (ticketPrice * 1) - ((ticketPrice*1) * (discount/100));
        $('#editTotalPrice').val(toRupiah(result));
        $('#editTotalDiscount').val(toRupiah(totalDiscount));
    });
});