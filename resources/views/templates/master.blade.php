<!DOCTYPE html>
<html dir="ltr" lang="en">

@include('templates.partials.head')

<body>
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @include('templates.partials.header')

        @include('templates.partials.sidebar')

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">@yield('pwd')</h3>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="@yield('pwd-title-link')">@yield('pwd-title')</a>
                        </li>
                        <li class="breadcrumb-item active">@yield('pwd-subtitle')</li>
                    </ol>
                </div>
                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                        <div class="d-flex me-3 ms-2">
                            <div class="chart-text me-2">
                                <h6 class="mb-0"><small>THIS MONTH</small></h6>
                                <h4 class="mt-0 text-info">{{saleThisMonth()}}</h4>
                            </div>
                        </div>
                        <div class="d-flex ms-2">
                            <div class="chart-text me-2">
                                <h6 class="mb-0"><small>LAST MONTH</small></h6>
                                <h4 class="mt-0 text-primary">{{saleLastMonth()}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-xl-12">
                        @yield('content')
                    </div>
                    @yield('modal')
                </div>
            </div>
            <footer class="footer">
                All Rights Reserved by Materialpro admin.
            </footer>
        </div>
    </div>
    <div class="chat-windows"></div>
    @include('templates.partials.script')
</body>

</html>