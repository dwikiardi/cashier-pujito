<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material pro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="Material Pro is powerful and clean admin dashboard template" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Sistem Informasi Eksekutif Desa Ceking</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/uploads/media/logo/logo_desa.png')}}" />
    <!-- Custom CSS -->
    <link href="{{asset('assets/templates/auth/css/style.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="main-wrapper">
        <!-- Login box.scss -->
        <!-- -------------------------------------------------------------- -->
        <div class="row auth-wrapper gx-0">
            <div class="col-lg-4 col-xl-3 bg-info auth-box-2 on-sidebar">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-7 col-lg-12 col-xl-9">
                            <div>
                                <span class="db"><img
                                        src="{{asset('assets/templates/auth/images/logo-light-icon.png')}}"
                                        alt="logo" /></span>
                                <span class="db"><img
                                        src="{{asset('assets/templates/auth/images/logo-light-text.png')}}"
                                        alt="logo" /></span>
                            </div>
                            <h2 class="text-white mt-4 fw-light">
                                SIE
                                <span class="font-weight-medium">Desa Ceking Tegallalang</span> Berbasis Web
                            </h2>
                            <p class="op-5 text-white fs-4 mt-4">
                                {{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                do eiusmod tempor incididunt. --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9 d-flex align-items-center justify-content-center">
                <div class="row justify-content-center w-100 mt-4 mt-lg-0">
                    <div class="col-lg-6 col-xl-5 col-md-7">
                        <div class="card" id="registerform">
                            <div class="card-body">
                                <h2>Sign Up Form</h2>
                                <p class="text-muted fs-4">
                                    Enter given details for new account
                                </p>
                                <form class="form-horizontal mt-4 pt-4" id="formRegister">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control form-input-bg" id="name"
                                            placeholder="john deo" name="name" />
                                        <label for="name">Full Name</label>
                                        <div class="invalid-feedback error-name"></div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="gender" id="gender" class="form-control form-input-bg">
                                            <option value="1">Laki - Laki</option>
                                            <option value="0">Perempuan</option>
                                        </select>
                                        <label for="gender">Jenis Kelamin</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control form-input-bg" id="phone"
                                            placeholder="08xxxxxxx" name="phone" />
                                        <label for="phone">No. Telp</label>
                                        <div class="invalid-feedback error-phone"></div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea name="address" id="address" class="form-control form-input-bg"
                                            rows="3"></textarea>
                                        <label for="address">Alamat</label>
                                        <div class="invalid-feedback error-address"></div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="file" class="form-control form-input-bg" id="image" name="image" />
                                        <label for="image">Foto</label>
                                        <div class="invalid-feedback error-image"></div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control form-input-bg" id="email"
                                            placeholder="john@gmail.com" name="email" />
                                        <label for="tb-remail">Email</label>
                                        <div class="invalid-feedback error-email"></div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control form-input-bg" id="password"
                                            placeholder="*****" name="password" />
                                        <label for="text-rpassword">Password</label>
                                        <div class="invalid-feedback error-password"></div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control form-input-bg"
                                            id="passwordConfirmation" placeholder="*****"
                                            name="password_confirmation" />
                                        <label for="text-rcpassword">Confirm Password</label>
                                        <div class="invalid-feedback error-password-confirmation"></div>
                                    </div>
                                    <div class="d-flex align-items-stretch button-group">
                                        <button type="button" class="btn btn-info btn-lg px-4 btn-register">
                                            Submit
                                        </button>
                                        <a href="javascript:void(0)" id="to-login2"
                                            class="btn btn-lg btn-light-secondary text-secondary font-weight-medium">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card" id="loginform">
                            <div class="card-body">
                                <h2>Welcome to SIE Desa Ceking</h2>
                                <p class="text-muted fs-4">
                                    New Here?
                                    <a href="javascript:void(0)" id="to-register">Create an account</a>
                                </p>
                                <form class="form-horizontal mt-4 pt-4 needs-validation" action="{{route('login')}}"
                                    method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="email"
                                            class="form-control form-input-bg @error('email') is-invalid @enderror"
                                            id="email" placeholder="name@example.com" name="email"
                                            value="{{ old('email') }}" />
                                        <label for="email">Email</label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password"
                                            class="form-control form-input-bg @error('password') is-invalid @enderror"
                                            id="password" placeholder="*****" name="password" />
                                        <label for="text-password">Password</label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="d-flex align-items-center mb-3">
                                        <div class="ms-auto">
                                            <label>Belum ada akun?</label>
                                            <a href="javascript:void(0)" id="to-recover" class="fw-bold">Sign up</a>
                                        </div>
                                    </div> --}}
                                    <div class="d-flex align-items-stretch button-group mt-4">
                                        <button type="submit" class="btn btn-info btn-lg px-4 pull-right">
                                            Sign in
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Login box.scss -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- All Required js -->
    <!-- -------------------------------------------------------------- -->
    <script src="{{asset('assets/templates/auth/js/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/templates/auth/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if ($message = Session::get('not_active'))
    <script>
        toastr["error"]('{!!$message!!}', "Error")
    </script>
    @endif
    <script>
        $("#to-login").on("click", function () {
            $("#loginform").fadeIn();
            $("#recoverform").hide();
        });

        $("#to-register").on("click", function () {
            $("#loginform").hide();
            $("#registerform").fadeIn();
        });

        $("#to-login2").on("click", function () {
            $("#loginform").fadeIn();
            $("#registerform").hide();
        });

        $('body').on('click', '.btn-register', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let form = $('#formRegister')[0]
            let data = new FormData(form)
            $.ajax({
                type: "POST",
                url: "community/register",
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
                    $('#formRegister').trigger('reset')
                    $("#loginform").fadeIn();
                    $("#registerform").hide();
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
                                $('#password_confirmation').trigger('focus')
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

      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function () {
        "use strict";

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll(".needs-validation");

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form) {
          form.addEventListener(
            "submit",
            function (event) {
              if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
              }

              form.classList.add("was-validated");
            },
            false
          );
        });
      })();
    </script>
</body>

</html>