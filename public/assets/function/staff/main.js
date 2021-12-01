function getStaffs() {
    $.ajax({
        type: "get",
        url: "/manager/staff/render",
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
    getStaffs();

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
        let form = $('#formAddData')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/manager/staff/store",
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
                // alert('sukses')
                toastr[response.status](response.message, response.title);
                $('#formAddData').trigger('reset')
                $("#modalAddData").modal("hide");
                $(".invalid-feedback").html('')
                getStaffs();
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
                        if (error.responseJSON.errors.place_of_birth) {
                            $('#placeOfBirth').addClass('is-invalid')
                            $('#placeOfBirth').trigger('focus')
                            $('.error-place-of-birth').html(error.responseJSON.errors.place_of_birth)
                        } else {
                            $('#placeOfBirth').removeClass('is-invalid')
                            $('.error-place-of-birth').html('')
                        }
                        if (error.responseJSON.errors.date_of_birth) {
                            $('#dateOfBirth').addClass('is-invalid')
                            $('#dateOfBirth').trigger('focus')
                            $('.error-date-of-birth').html(error.responseJSON.errors.date_of_birth)
                        } else {
                            $('#dateOfBirth').removeClass('is-invalid')
                            $('.error-date-of-birth').html('')
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
                        if (error.responseJSON.errors.email) {
                            $('#email').addClass('is-invalid')
                            $('#email').trigger('focus')
                            $('.error-email').html(error.responseJSON.errors.email)
                        } else {
                            $('#email').removeClass('is-invalid')
                            $('.error-email').html('')
                        }
                        if (error.responseJSON.errors.password) {
                            $('#password').addClass('is-invalid')
                            $('#password').trigger('focus')
                            $('.error-password').html(error.responseJSON.errors.password)
                        } else {
                            $('#password').removeClass('is-invalid')
                            $('.error-password').html('')
                        }
                        if (error.responseJSON.errors.password_confirmation) {
                            $('#passwordConfirmation').addClass('is-invalid')
                            $('#passwordConfirmation').trigger('focus')
                            $('.error-password-confirmation').html(error.responseJSON.errors.password_confirmation)
                        } else {
                            $('#passwordConfirmation').removeClass('is-invalid')
                            $('.error-password-confirmation').html('')
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

    // btn edit
    $('body').on('click', '.btn-edit', function () {
        let admin_id = $(this).data('id');
        $('#modalEditData').modal('show');

        $.get("/manager/staff/edit/"+admin_id, function (data) {
            $('#modalEditData .modal-title').text('Ubah Data Staff ' + data.name)
            $('#editAdminId').val(data.id)
            $('#editEmail').val(data.user.email)
            $('#editName').val(data.name)
            $('#editAddress').val(data.address)
            $('#editGender').val(data.gender)
            $('#editPhone').val(data.phone)
            $('#editPlaceOfBirth').val(data.place_of_birth)
            $('#editDateOfBirth').val(data.date_of_birth)
        });
    });

    // on update form
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
            url: "/manager/staff/update",
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
                // alert('sukses')
                toastr[response.status](response.message, response.title);
                $('#formEditData').trigger('reset')
                $("#modalEditData").modal("hide");
                $(".invalid-feedback").html('')
                getStaffs();
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
                        if (error.responseJSON.errors.place_of_birth) {
                            $('#editPlaceOfBirth').addClass('is-invalid')
                            $('#editPlaceOfBirth').trigger('focus')
                            $('.error-edit-place-of-birth').html(error.responseJSON.errors.place_of_birth)
                        } else {
                            $('#editPlaceOfBirth').removeClass('is-invalid')
                            $('.error-edit-place-of-birth').html('')
                        }
                        if (error.responseJSON.errors.date_of_birth) {
                            $('#editDateOfBirth').addClass('is-invalid')
                            $('#editDateOfBirth').trigger('focus')
                            $('.error-edit-date-of-birth').html(error.responseJSON.errors.date_of_birth)
                        } else {
                            $('#editDateOfBirth').removeClass('is-invalid')
                            $('.error-edit-date-of-birth').html('')
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
                        if (error.responseJSON.errors.email) {
                            $('#editEmail').addClass('is-invalid')
                            $('#editEmail').trigger('focus')
                            $('.error-edit-email').html(error.responseJSON.errors.email)
                        } else {
                            $('#editEmail').removeClass('is-invalid')
                            $('.error-edit-email').html('')
                        }
                        if (error.responseJSON.errors.image) {
                            $('#editImage').addClass('is-invalid')
                            $('#editImage').trigger('focus')
                            $('.error-edit-image').html(error.responseJSON.errors.image)
                        } else {
                            $('#editImage').removeClass('is-invalid')
                            $('.error-edit-image').html('')
                        }
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-change-status', function(){
        let status = $(this).data('status');
        let id = $(this).data('id');
        let title = '';
        let text = '';
        let requestStatus = '';
        if(status == true) {
            title = 'Aktifkan kembali staf ini?';
            text = 'aktifkan';
            requestStatus = 1
        } else {
            title = 'Non-aktifkan staf ini?';
            text = 'non-aktifkan';
            requestStatus = 0
        }

        Swal.fire({
            icon: 'warning',
            title: title,
            text: text,
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
                        url: "/manager/staff/change-status",
                        data: {
                            id: id,
                            status: requestStatus,
                        },
                    })
                        .done(function (response) {
                            getStaffs();
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