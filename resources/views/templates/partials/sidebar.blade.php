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
                    <a class="dropdown-item" href="{{route('logout')}}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>{{ __('Logout')
                        }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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
                <li class="sidebar-item {{Request::is('bill') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('bill.index')}}"
                        aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item {{Request::is('customer') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('customer.index')}}"
                        aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span
                            class="hide-menu">Customer</span></a>
                </li>
                <li class="sidebar-item {{Request::is('package') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('package.index')}}"
                        aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span
                            class="hide-menu">Package</span></a>
                </li>
                <li class="sidebar-item {{Request::is('bandwidth') ? 'selected' : ''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('bandwidth.index')}}"
                        aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span
                            class="hide-menu">Bandwidth</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><i
                class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>