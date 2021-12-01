function getTickets() {
    $.ajax({
        type: "get",
        url: "/admin/ticket/render",
        dataType: "json",
        success: function (response) {
            $(".data-rendered").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

/* convert to rupiah */
var rupiah = $("#price");
function convertToRupiah(number, prefix) {
    var number_string = number.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        remaining = split[0].length % 3,
        rupiah = split[0].substr(0, remaining),
        thousand = split[0].substr(remaining).match(/\d{3}/gi);

    if (thousand) {
        separator = remaining ? "." : "";
        rupiah += separator + thousand.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

$(document).ready(function () {
    getTickets();

    $('body').on('click', '.btn-add', function(){
        $('#modalAddData').modal('show');
    });

    $("body").on("keyup", '#price, #editPrice', function (e) {
        $("#price, #editPrice").val(convertToRupiah($(this).val(), "Rp. "))
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
            url: "/admin/ticket/store",
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
                getTickets();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.title) {
                            $('#title').addClass('is-invalid')
                            $('#title').trigger('focus')
                            $('.error-title').html(error.responseJSON.errors.title)
                        } else {
                            $('#title').removeClass('is-invalid')
                            $('.error-title').html('')
                        }
                        if (error.responseJSON.errors.price) {
                            $('#price').addClass('is-invalid')
                            $('#price').trigger('focus')
                            $('.error-price').html(error.responseJSON.errors.price)
                        } else {
                            $('#price').removeClass('is-invalid')
                            $('.error-price').html('')
                        }
                        if (error.responseJSON.errors.description) {
                            $('#description').addClass('is-invalid')
                            $('#description').trigger('focus')
                            $('.error-description').html(error.responseJSON.errors.description)
                        } else {
                            $('#description').removeClass('is-invalid')
                            $('.error-description').html('')
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

        $.get("/admin/ticket/edit/"+ticket_id, function (data) {
            $('#modalEditData .modal-title').text('Edit Tiket ' + data.title)
            $('#ticketId').val(data.id)
            $('#editTitle').val(data.title)
            $('#editPrice').val(data.price)
            $('#editDescription').text(data.description)
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
            url: "/admin/ticket/update",
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
                getTickets();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.title) {
                            $('#editTitle').addClass('is-invalid')
                            $('#editTitle').trigger('focus')
                            $('.error-edit-title').html(error.responseJSON.errors.title)
                        } else {
                            $('#editTitle').removeClass('is-invalid')
                            $('.error-edit-title').html('')
                        }
                        if (error.responseJSON.errors.price) {
                            $('#editPrice').addClass('is-invalid')
                            $('#editPrice').trigger('focus')
                            $('.error-edit-price').html(error.responseJSON.errors.price)
                        } else {
                            $('#editPrice').removeClass('is-invalid')
                            $('.error-edit-price').html('')
                        }
                        if (error.responseJSON.errors.description) {
                            $('#editDescription').addClass('is-invalid')
                            $('#editDescription').trigger('focus')
                            $('.error-edit-description').html(error.responseJSON.errors.description)
                        } else {
                            $('#editDescription').removeClass('is-invalid')
                            $('.error-edit-description').html('')
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
                        url: "/admin/ticket/delete",
                        data: {
                            id: id,
                        },
                    })
                        .done(function (response) {
                            getTickets();
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
});