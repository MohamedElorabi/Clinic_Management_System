<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ !empty($title)?$title:'عيادة دكتور'}}</title>
    <link rel="apple-touch-icon" href="{{asset('dashboard/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('dashboard/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/extensions/shepherd-theme-default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/vendors/css/tables/datatable/datatables.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/pages/dashboard-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/pages/card-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/plugins/tour/tour.css')}}">
    <!-- END: Page CSS -->


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css-rtl/custom-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/style-rtl.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->


<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">


    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                
                <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->
                        <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->
                        <!--     i.ficon.feather.icon-menu-->
                        
                    </ul>
                    <ul class="nav navbar-nav">
                            <div class="bookmark-input search-input">
                                <div class="bookmark-input-icon"><i class="feather icon-search primary"></i></div>
                                <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="0" data-search="template-list">
                                <ul class="search-list search-list-bookmark ps"><div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; left: -7px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></ul>
                            </div>
                            <!-- select.bookmark-select-->
                            <!--   option Chat-->
                            <!--   option email-->
                            <!--   option todo-->
                            <!--   option Calendar-->
                        </li>
                    </ul>
                </div>

                    <ul class="nav navbar-nav float-right">

                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ Auth::user()->user_name }}</span></div><span><img class="round" src="{{asset('dashboard/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="feather icon-power"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </nav>

    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
            </a></li>
    </ul>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('dashboard.layouts.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->


    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">

                <!-- Dashboard Analytics Start -->
                @yield('content')
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

   <!-- BEGIN: Footer-->
   <footer class="footer footer-static footer-light">
   <p class="clearfix blue-grey lighten-2 mb-0">
        <span class="float-md-left d-md-inline-block mt-25">جميع الحقوق محفوظة © 2020<a class="text-bold-800 grey darken-2"></a></span>
        <span class="float-md-right d-md-block">Developed by<a class="text-bold-800 grey darken-2" href="https://www.facebook.com/mohamed.elorabi77" target="_blank">Mohamed Elorabi</a></i></span>
    </p>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('dashboard/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('dashboard/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/extensions/tether.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/js/extensions/shepherd.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('dashboard/js/core/app-menu.js')}}"></script>
    <script src="{{asset('dashboard/js/core/app.js')}}"></script>
    <script src="{{asset('dashboard/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
     <script src="{{asset('dashboard/js/scripts/pages/dashboard-analytics.js')}}"></script>
     <script src="{{asset('dashboard/js/scripts/datatables/datatable.js')}}"></script>
    <!-- END: Page JS-->
@yield('script')
</body>
<!-- END: Body-->

</html>
