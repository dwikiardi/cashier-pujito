// function to get data event from database
function getBandwidth() {
    $.ajax({
        type: "get",
        url: "bandwidth/render",
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
    // call perform
    getBandwidth();

    // trigger the button to open the modal
    $("body").on("click", ".btn-add", function () {
        $("#modalAddData").modal("show");
        $('#modalAddData').on('shown.bs.modal', function () {
            $('#customerId').select2({
                placeholder: "Select a state"
            });
        })
        $('#packageId').change(function(){
            var package_id = $(this).val();
            $.get("package/edit/"+package_id, function (data) {
                $('.price').val(data.price);
            });
        });
    });

    // on submit form
    $('body').on('click', '.btn-save', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#form-bandwidth')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "bandwidth/store",
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
                $('#form-bandwidth').trigger('reset')
                $("#modalAddData").modal("hide");
                getBandwidth();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.ip_radio) {
                            $('#ipRadio').addClass('is-invalid')
                            $('#ipRadio').trigger('focus')
                            $('.error-ip-radi0').html(error.responseJSON.errors.ip_radio)
                        } else {
                            $('#ipRadio').removeClass('is-invalid')
                            $('.error-ip-radi0').html('')
                        }
                        if (error.responseJSON.errors.ip_access) {
                            $('#ipAccess').addClass('is-invalid')
                            $('#ipAccess').trigger('focus')
                            $('.error-ip-access').html(error.responseJSON.errors.ip_access)
                        } else {
                            $('#ipAccess').removeClass('is-invalid')
                            $('.error-ip-access').html('')
                        }
                    }
                }
            }
        });
    });

    // trigger button edit
    $('body').on('click', '.btn-edit', function () {
        let bandwidth_id = $(this).data('id');
        $('#modalEditData').modal('show')
        $.get("bandwidth/edit/" + bandwidth_id, function (data) {
            console.log('')
            $('#editBandwidthId').val(data.id);
            $('#editPackageId').val(data.package.id).change();
            $('#editIpRadio').val(data.ip_radio);
            $('#editIpAccess').val(data.ip_access);
            $('#editCustomerId').val(data.customer.id).change();
            $('#editPrice').val(data.package.price);
            $('#editPackageId').change(function(){
                var package_id = $(this).val();
                $.get("package/edit/"+package_id, function (data) {
                    $('.price').val(data.price);
                });
            });
        });
    });

    // update data bandwidth
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#form-edit-bandwidth')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "bandwidth/update",
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
                $('#form-edit-bandwidth').trigger('reset')
                $("#modalEditData").modal("hide");
                getBandwidth();
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.ip_radio) {
                            $('#editIpRadio').addClass('is-invalid')
                            $('#editIpRadio').trigger('focus')
                            $('.error-edit-ip-radio').html(error.responseJSON.errors.ip_radio)
                        } else {
                            $('#editIpRadio').removeClass('is-invalid')
                            $('.error-edit-ip-radio').html('')
                        }
                        if (error.responseJSON.errors.bandwidth) {
                            $('#editIpAccess').addClass('is-invalid')
                            $('#editIpAccess').trigger('focus')
                            $('.error-edit-ip-access').html(error.responseJSON.errors.ip_access)
                        } else {
                            $('#editIpAccess').removeClass('is-invalid')
                            $('.error-edit-ip-access').html('')
                        }
                    }
                }
            }
        });
    });

    // trigger button delete
    $('body').on('click', '.btn-delete', function () {
        let bandwidth_id = $(this).data('id');
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
                            url: "bandwidth/delete",
                            data: {
                                bandwidth_id: bandwidth_id,
                            },
                        })
                        .done(function (response) {
                            // toastr[response.status](response.message, response.title);
                            getBandwidth();
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
});