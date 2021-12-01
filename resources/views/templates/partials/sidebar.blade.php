<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile position-relative"
            style="background: url(https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/assets/images/background/user-info.jpg)no-repeat;">
            <!-- User profile image -->
            <div class="profile-img">
                <img src="{{asset(auth()->user()->image)}}" alt="user" class="w-100" />
            </div>
            <!-- User profile text-->
            <div class="profile-text pt-1 dropdown">
                <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative "
                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">{{username()}}</a>
                <div class="dropdown-menu animated flipInY" aria-labelledby="dropdownMenuLink">
                    {{-- <a class="dropdown-item" href="#"><i data-feather="user"
                            class="feather-sm text-info me-1 ms-1"></i>
                        My Profile</a>
                    <a class="dropdown-item" href="#"><i data-feather="credit-card"
                            class="feather-sm text-info me-1 ms-1"></i>
                        My Balance</a>
                    <a class="dropdown-item" href="#"><i data-feather="mail"
                            class="feather-sm text-success me-1 ms-1"></i>
                        Inbox</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i data-feather="settings"
                            class="feather-sm text-warning me-1 ms-1"></i>
                        Account Setting</a>
                    <div class="dropdown-divider"></div> --}}
                    {{-- <a class="dropdown-item"
                        href="https://demos.wrappixel.com/premium-admin-templates/bootstrap/materialpro-bootstrap/package/html/material/authentication-login3.html"><i
                            data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>
                        Logout</a> --}}
                    <a class="dropdown-item" href="{{route('logout')}}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>{{ __('Logout')
                        }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    {{-- <div class="dropdown-divider"></div> --}}
                    {{-- <div class="ps-4 p-2">
                        <a href="#" class="btn d-block w-100 btn-info rounded-pill">View Profile</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <li class="sidebar-item {{Request::is('dashboard') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('dashboard') ? 'active' : ''}}"
                        href="{{route('dashboard')}}" aria-expanded="false"><i class="mdi mdi-home"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                @can('isAdmin', Model::class)
                <li class="sidebar-item {{Request::is('admin/ticket') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.ticket.index')}}"
                        aria-expanded="false"><i class="mdi mdi-comment-processing-outline"></i><span
                            class="hide-menu">Tiket</span></a>
                </li>
                <li class="sidebar-item {{Request::is('admin/sale') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.sale.index')}}"
                        aria-expanded="false"><i class="mdi mdi-cash-usd"></i><span
                            class="hide-menu">Penjualan</span></a>
                </li>
                <li class="sidebar-item {{Request::is('admin/community') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{route('admin.community.index')}}" aria-expanded="false"><i
                            class="mdi mdi-account"></i><span class="hide-menu">Masyarakat</span></a>
                </li>
                @endcan
                @can('isManager')
                <li class="sidebar-item {{Request::is('manager/staff') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('manager.staff.index')}}"
                        aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Staff</span></a>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        {{--
        <!-- item-->
        <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><i
                class="ti-settings"></i></a>
        <!-- item-->
        <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><i
                class="mdi mdi-gmail"></i></a>
        <!-- item--> --}}
        <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><i
                class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>