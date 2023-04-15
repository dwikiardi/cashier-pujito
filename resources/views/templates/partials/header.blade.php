<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand"
                href="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/html/material/index.html">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/images/logo-icon.png"
                        alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/images/logo-light-icon.png"
                        alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    {{-- <img
                        src="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/images/logo-text.png"
                        alt="homepage" class="dark-logo" /> --}}
                    <!-- Light Logo text -->
                    {{-- <img
                        src="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/images/logo-light-text.png"
                        class="light-logo" alt="homepage" /> --}}
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin2">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
                <!-- This is  -->
                <li class="nav-item">
                    <a class="
            nav-link
            sidebartoggler
            d-none d-md-block
            waves-effect waves-dark
          " href="javascript:void(0)"><i class="ti-menu"></i></a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav">
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('assets/uploads/media/users/blank.png')}}" alt="user" width="30"
                            class="profile-pic rounded-circle" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                            <div class="">
                                <img src="{{asset('assets/uploads/media/users/blank.png')}}" alt="user" class="rounded-circle"
                                    width="60" />
                            </div>
                            <div class="ms-2">
                                <h4 class="mb-0 text-white">{{username()}}</h4>
                                <p class="mb-0">{{auth()->user()->email}}</p>
                            </div>
                        </div>
                        {{-- <a class="dropdown-item" href="#"><i data-feather="settings"
                                class="feather-sm text-warning me-1 ms-1"></i>
                            Account Setting</a> --}}
                        {{-- <div class="dropdown-divider"></div> --}}
                        {{-- <a class="dropdown-item" href="#"><i data-feather="log-out"
                                class="feather-sm text-danger me-1 ms-1"></i>
                            Logout</a> --}}
                        <a class="dropdown-item" href="{{route('logout')}}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>{{ __('Logout')
                            }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{-- <div class="dropdown-divider"></div> --}}
                        {{-- <div class="pl-4 p-2">
                            <a href="#" class="btn d-block w-100 btn-info rounded-pill">View Profile</a>
                        </div> --}}
                    </div>
                </li>
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
