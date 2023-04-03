// function to get data member from database
function getPackage() {
    $.ajax({
        type: "get",
        url: "package/render",
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
    getPackage();

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
        let form = $('#form-package')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "package/store",
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
                $('#form-package').trigger('reset')
                $("#modalAddData").modal("hide");
                getPackage();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.price) {
                            $('#price').addClass('is-invalid')
                            $('#price').trigger('focus')
                            $('.error-price').html(error.responseJSON.errors.price)
                        } else {
                            $('#price').removeClass('is-invalid')
                            $('.error-price').html('')
                        }
                        if (error.responseJSON.errors.bandwidth) {
                            $('#bandwidth').addClass('is-invalid')
                            $('#bandwidth').trigger('focus')
                            $('.error-bandwidth').html(error.responseJSON.errors.bandwidth)
                        } else {
                            $('#bandwidth').removeClass('is-invalid')
                            $('.error-bandwidth').html('')
                        }
                    }
                }
            }
        });
    });

    // trigger button edit
    $('body').on('click', '.btn-edit', function () {
        let package_id = $(this).data('id');
        $('#modalEditData').modal('show')
        $.get("package/edit/" + package_id, function (data) {
            $('#editPackageId').val(data.id);
            $('#editPrice').val(data.price);
            $('#editBandwidth').val(data.bandwidth);
        });
    })

    // update data package
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#form-edit-package')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "package/update",
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
                $('#form-edit-package').trigger('reset')
                $("#modalEditData").modal("hide");
                getPackage();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.price) {
                            $('#editPrice').addClass('is-invalid')
                            $('#editPrice').trigger('focus')
                            $('.error-edit-price').html(error.responseJSON.errors.price)
                        } else {
                            $('#editPrice').removeClass('is-invalid')
                            $('.error-edit-price').html('')
                        }
                        if (error.responseJSON.errors.bandwidth) {
                            $('#editBandwidth').addClass('is-invalid')
                            $('#editBandwidth').trigger('focus')
                            $('.error-edit-bandwidth').html(error.responseJSON.errors.bandwidth)
                        } else {
                            $('#editBandwidth').removeClass('is-invalid')
                            $('.error-edit-bandwidth').html('')
                        }
                    }
                }
            }
        });
    });

    // trigger button delete
    $('body').on('click', '.btn-delete', function () {
        let package_id = $(this).data('id');
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
                            url: "package/delete",
                            data: {
                                package_id: package_id,
                            },
                        })
                        .done(function (response) {
                            // toastr[response.status](response.message, response.title);
                            getPackage();
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