<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@lang('admin.main_title')</title>
        <link rel="icon" type="image/x-icon" href="/@jzon/images/admin_dashboard.ico">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css" />
        <!-- IonIcons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css" />

        <script src="/@jzon/js/jquery-3.6.0.min.js"></script>

        <link href="/admin/plugins/select2/css/select2.min.css" rel="stylesheet" />
        <script src="/admin/plugins/select2/js/select2.min.js" defer></script>
        
        <script src="/@jzon/js/sweetalert2.min.js"></script>

    </head>

    <style>
        .bold {
            font-weight: bold!important;
        }

        .italic {
            font-style: italic!important;
        }
    </style>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('home.index') }}" class="nav-link">Home</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('admin.dashboard') }}" class="brand-link">
                    <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
                    <span class="brand-text font-weight-light">ADMIN DASH</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }} <img src="/@jzon/images/verify.png" alt="verify" style="margin-left: 3px; width: 16px; height: 16px;"></a> 
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                            <li class="nav-item">
                                <a href="{{ route("admin.dashboard") }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        @lang("admin.dashboard")
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">GENERAL</li>

                            <li class="nav-item">
                                <a href="{{ route("admin.manage_users") }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        @lang("admin.manage_users")
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("admin.manage_orders") }}" class="nav-link">
                                    <i class="nav-icon fas fa-archive"></i>
                                    <p>
                                        @lang("admin.manage_orders")
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("admin.manage_categories") }}" class="nav-link">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        @lang("admin.manage_categories")
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("admin.manage_products") }}" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        @lang("admin.manage_products")
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route("admin.manage_payments") }}" class="nav-link">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>
                                        @lang("admin.manage_payments")
                                    </p>
                                </a>
                            </li>
                            
                            <li class="nav-header">SETTINGS</li>
                            <li class="nav-item">
                                <a href="{{ route("admin.view_setting", "website") }}" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        @lang("admin.setting_website")
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.view_setting", "security") }}" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        @lang("admin.setting_security")
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.view_setting", "currency") }}" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        @lang("admin.setting_currency")
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('title')</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }} <a href="https://github.com/ducthanh-jtech">Jzon Tech</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    Coded by <b>Jzon</b>
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        @if (session('error'))
        <script>
            Swal.fire({
                title: "{{ __('system.swal_title_failed') }}",
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{ __("system.swal_btn_close") }}'
            })
        </script>
        @endif

        @if (session('success'))
        <script>
            Swal.fire({
                title: "{{ __('system.swal_title_success') }}",
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{ __("system.swal_btn_close") }}'
            })
        </script>
        @endif

        <!-- jQuery -->
        <script src="/admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE -->
        <script src="/admin/dist/js/adminlte.js"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="/admin/plugins/chart.js/Chart.min.js"></script>
        <!-- AdminLTE for demo purposes -->
    </body>
</html>
