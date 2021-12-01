function getCommunity() {
    $.ajax({
        type: "get",
        url: "/admin/community/render",
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
    getCommunity();

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
                        url: "/admin/community/change-status",
                        data: {
                            id: id,
                            status: requestStatus,
                        },
                    })
                        .done(function (response) {
                            getCommunity();
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