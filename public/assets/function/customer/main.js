// function to get data member from database
function getCustomer() {
    $.ajax({
        type: "get",
        url: "customer/render",
        dataType: "json",
        success: function (response) {
            $(".data-rendered").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    // call getMember function
    getCustomer();

    // trigger the button to open the modal
    $("body").on("click", ".btn-add", function () {
        $("#modalAddData").modal("show");
    });

    // on submit form
    $('body').on('click', '.btn-save', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#form-customer')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "customer/store",
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
                $('#form-customer').trigger('reset')
                $("#modalAddData").modal("hide");
                getCustomer();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.name) {
                            $('#name').addClass('is-invalid')
                            $('#name').trigger('focus')
                            $('.error-name').html(error.responseJSON.errors.name)
                        } else {
                            $('#name').removeClass('is-invalid')
                            $('.error-name').html('')
                        }
                        if (error.responseJSON.errors.phone) {
                            $('#phone').addClass('is-invalid')
                            $('#phone').trigger('focus')
                            $('.error-phone').html(error.responseJSON.errors.phone)
                        } else {
                            $('#phone').removeClass('is-invalid')
                            $('.error-phone').html('')
                        }
                        if (error.responseJSON.errors.address) {
                            $('#address').addClass('is-invalid')
                            $('#address').trigger('focus')
                            $('.error-address').html(error.responseJSON.errors.address)
                        } else {
                            $('#address').removeClass('is-invalid')
                            $('.error-address').html('')
                        }
                        if (error.responseJSON.errors.image) {
                            $('#image').addClass('is-invalid')
                            $('#image').trigger('focus')
                            $('.error-image').html(error.responseJSON.errors.image)
                        } else {
                            $('#image').removeClass('is-invalid')
                            $('.error-image').html('')
                        }
                    }
                }
            }
        });
    });

    // trigger button edit
    $('body').on('click', '.btn-edit', function () {
        let customer_id = $(this).data('id');
        $('#modalEditData').modal('show')
        $.get("customer/edit/" + customer_id, function (data) {
            $('#editCustomerId').val(data.id);
            $('#editName').val(data.name);
            $('#editPhone').val(data.phone);
            $('#editAddress').val(data.address);
        });
    })

    // update status customer
    $("body").on('change', '#status', function () {
        let customer_id = $(this).data("id");
        let status = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "customer/update-status",
            data: {
                customer_id: customer_id,
                status: status
            },
            dataType: "json",
            success: function (response) {
                toastr[response.status](response.message, response.title);
                getCustomer();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        });
    });

    // update data member
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#form-edit-customer')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "customer/update",
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
                $('.btn-update').html('Save')
            },
            success: function (response) {
                toastr[response.status](response.message, response.title);
                $('#form-edit-customer').trigger('reset')
                $("#modalEditData").modal("hide");
                getCustomer();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.name) {
                            $('#editName').addClass('is-invalid')
                            $('#editName').trigger('focus')
                            $('.error-edit-name').html(error.responseJSON.errors.name)
                        } else {
                            $('#editName').removeClass('is-invalid')
                            $('.error-edit-name').html('')
                        }
                        if (error.responseJSON.errors.phone) {
                            $('#editPhone').addClass('is-invalid')
                            $('#editPhone').trigger('focus')
                            $('.error-edit-phone').html(error.responseJSON.errors.phone)
                        } else {
                            $('#editPhone').removeClass('is-invalid')
                            $('.error-edit-phone').html('')
                        }
                        if (error.responseJSON.errors.address) {
                            $('#editAddress').addClass('is-invalid')
                            $('#editAddress').trigger('focus')
                            $('.error-edit-address').html(error.responseJSON.errors.address)
                        } else {
                            $('#editAddress').removeClass('is-invalid')
                            $('.error-edit-address').html('')
                        }
                    }
                }
            }
        });
    });

    // trigger button delete
    $('body').on('click', '.btn-delete', function () {
        let customer_id = $(this).data('id');
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
                            url: "customer/delete",
                            data: {
                                customer_id: customer_id,
                            },
                        })
                        .done(function (response) {
                            // toastr[response.status](response.message, response.title);
                            getCustomer();
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
    })
});