<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Favicon icon-->
        <link rel="shortcut icon" type="image/x-icon" href="{{ setting('favicon') }}" />

        <!-- Libs CSS -->
        <script src="/public/js/jquery-3.6.0.min.js"></script>
        <script src="/public/js/sweetalert2.min.js"></script>
        {{-- <link href="/client/assets/libs/select2/select2.min.css" rel="stylesheet" />
        <script src="/client/assets/libs/select2/select2.min.js"></script> --}}

        <link href="/client/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="/client/assets/libs/dropzone/dist/dropzone.css" rel="stylesheet" />
        <link href="/client/assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
        <link href="/client/assets/libs/prismjs/themes/prism-okaidia.css" rel="stylesheet" />
        <script src="/public/js/fontawesome.js"></script>
        
        <!-- Theme CSS -->
        <link rel="stylesheet" href="/client/assets/css/theme.min.css" />
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <title>{{ setting('client_title') }}</title>
    </head>

    <style>
        .bold {
            font-weight: bold!important;
        }

        .loading {
            z-index: 99999999;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            text-align: center;
            opacity: .8;
            background: #333;
            display: none;
        }

        .loading .loader {
            position: relative;
            top: calc(50% - 30px);
            color: #fff;
            width: 200px;
            padding: 20px;
            margin: auto;
            opacity: unset;
        }
    </style>

    <body class="bg-light">
        <div class="loading">
            <div class="loader">
                <i class="fa-solid fa-rotate fa-spin fa-2x"></i>
                <b style="margin-top: 10px; display: block; font-size: 20px;">Loading...</b>
            </div>
        </div>

        <div id="db-wrapper">
            <!-- navbar vertical -->
            <!-- Sidebar -->
            <nav class="navbar-vertical navbar">
                <div class="nav-scroller">
                    <!-- Brand logo -->
                    <a class="navbar-brand" href="{{ route('home.index') }}">
                        <img src="{{ setting('logo') }}" alt="" />
                    </a>
                    <!-- Navbar nav -->
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        @if (!Auth::check())

                        <li class="nav-item">
                            <div class="navbar-heading">🔒 AUTHENTICATION</div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('account.login') }}"> 
                                <i data-feather="log-in" class="nav-icon icon-xs me-2"></i> 
                                @lang('header.login')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('account.register') }}"> 
                                <i data-feather="plus-square" class="nav-icon icon-xs me-2"></i> 
                                @lang('header.register')
                            </a>
                        </li>
                        
                        @else

                        <li class="nav-item">
                            <div class="navbar-heading">👤 @lang('sidebar.account_section')</div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('account.profile') }}"> 
                                <i data-feather="user" class="nav-icon icon-xs me-2"></i> 
                                @lang('header.profile')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('account.profile') }}"> 
                                <i data-feather="activity" class="nav-icon icon-xs me-2"></i> 
                                @lang('header.activity')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('account.change_password') }}"> 
                                <i data-feather="lock" class="nav-icon icon-xs me-2"></i> 
                                @lang('sidebar.change_password')
                            </a>
                        </li>

                        @endif

                        <li class="nav-item">
                            <div class="navbar-heading">🏠 @lang('sidebar.dashboard_section')</div>
                        </li>

                        @if (Auth::check() && Auth::user()->role == "admin")
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('admin.dashboard') }}"> 
                                <i data-feather="cpu" class="nav-icon icon-xs me-2"></i> 
                                @lang('sidebar.admin')
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('home.index') }}"> 
                                <i data-feather="home" class="nav-icon icon-xs me-2"></i> 
                                @lang('sidebar.home')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('orders.index') }}"> 
                                <i data-feather="package" class="nav-icon icon-xs me-2"></i> 
                                @lang('sidebar.orders')
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="navbar-heading">🏦 @lang('sidebar.payment_section')</div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('deposit.index') }}"> 
                                <i data-feather="credit-card" class="nav-icon icon-xs me-2"></i> 
                                @lang('sidebar.deposit')
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="navbar-heading">🧰 @lang('sidebar.extensions_section')</div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('extension.authenticator') }}"> 
                                <i data-feather="key" class="nav-icon icon-xs me-2"></i> 
                                @lang('sidebar.extension_2fa')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="{{ route('extension.check_live_fb_uids') }}"> 
                                <i data-feather="send" class="nav-icon icon-xs me-2"></i> 
                                @lang('sidebar.extension_check_live_uid')
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>
            <!-- Page content -->
            <div id="page-content">
                <div class="header @@classList">
                    <!-- navbar -->
                    <nav class="navbar-classic navbar navbar-expand-lg">
                        <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                        {{-- <div class="ms-lg-3 d-none d-md-none d-lg-block">
                            <!-- Form -->
                            <form class="d-flex align-items-center">
                                <input type="search" class="form-control" placeholder="Search" />
                            </form>
                        </div> --}}
                        <!--Navbar nav -->
                        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                            @if(Auth::check())
                            
                            <li class="">
                                <li class="" style="margin-top: 2px; margin-right: 5px;">
                                    <span style="font-size: 25px; font-weight: bold; padding-top: 10px !important;" class="text-success">
                                        {{ displayCash(Auth::user()->cash) }}
                                    </span>
                                </li>
                            </li>

                            @endif
                            {{-- <li class="dropdown stopevent">
                                <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-xs" data-feather="bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                                    <div>
                                        <div class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                                            <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                                            <a href="#" class="text-muted">
                                                <span>
                                                    <i class="me-1 icon-xxs" data-feather="settings"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <!-- List group -->
                                        <ul class="list-group list-group-flush notification-list-scroll">
                                            <!-- List group item -->
                                            <li class="list-group-item bg-light">
                                                <a href="#" class="text-muted">
                                                    <h5 class="mb-1">Rishi Chopra</h5>
                                                    <p class="mb-0">
                                                        Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.
                                                    </p>
                                                </a>
                                            </li>
                                            <!-- List group item -->
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class="mb-1">Neha Kannned</h5>
                                                    <p class="mb-0">
                                                        Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.
                                                    </p>
                                                </a>
                                            </li>
                                            <!-- List group item -->
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class="mb-1">Nirmala Chauhan</h5>
                                                    <p class="mb-0">
                                                        Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.
                                                    </p>
                                                </a>
                                            </li>
                                            <!-- List group item -->
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class="mb-1">Sina Ray</h5>
                                                    <p class="mb-0">
                                                        Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="border-top px-3 py-2 text-center">
                                            <a href="#" class="text-inherit fw-semi-bold">
                                                View all Notifications
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}
                            <!-- List -->
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img alt="avatar" src="/client/assets/images/avatar/avatar-1.jpg" class="rounded-circle" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="px-4 pb-0 pt-2">
                                        <div class="lh-1">
                                            <h5 class="mb-1">
                                                @if(Auth::check())
                                                    {{ Auth::user()->name }}
                                                @else
                                                    @lang('header.guest')
                                                @endif
                                            </h5>

                                            @if (Auth::check())
                                            <a href="javascript:;" class="text-inherit fs-6 bold text-success">@lang('header.logged_in')</a>
                                            @else
                                            <a href="javascript:;" class="text-inherit fs-6 bold text-danger">@lang('header.not_login')</a>
                                            @endif
                                        </div>
                                        <div class="dropdown-divider mt-3 mb-2"></div>
                                    </div>

                                    <ul class="list-unstyled">
                                        @if(!Auth::check())
                                            
                                            <li>
                                                <a class="dropdown-item" href="{{ route('account.register') }}"> <i class="me-2 icon-xxs dropdown-item-icon" data-feather="plus-square"></i>
                                                    @lang('header.register')
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="{{ route('account.login') }}"> <i class="me-2 icon-xxs dropdown-item-icon" data-feather="log-in"></i>
                                                    @lang('header.login')
                                                </a>
                                            </li>

                                        @else

                                            <li>
                                                <a class="dropdown-item" href="{{ route('account.profile') }}"> <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>
                                                    @lang('header.profile')
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="{{ route('account.profile') }}"> <i class="me-2 icon-xxs dropdown-item-icon" data-feather="activity"></i>
                                                    @lang('header.activity')
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="{{ route('account.logout') }}"> <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>
                                                    @lang('header.logout')
                                                </a>
                                            </li>
                                        
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Container fluid -->
                <div class="pt-10 pb-21" style="background-image: url('{{ setting('client_image_banner') }}'); background-size: cover; box-shadow: inset 0 0 0 2000px rgb(34 41 47 / 45%);"></div>
                <div class="container-fluid mt-n22 px-6">

                    @yield('content')
                    
                </div>
            </div>
        </div>

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

        <!-- Scripts -->
        <!-- Libs JS -->
        <script src="/public/js/app.js?{{ time() }}"></script>
        <script src="/client/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/client/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="/client/assets/libs/feather-icons/dist/feather.min.js"></script>
        <script src="/client/assets/libs/prismjs/prism.js"></script>
        <script src="/client/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="/client/assets/libs/dropzone/dist/min/dropzone.min.js"></script>
        <script src="/client/assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
        <script src="/client/assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>

        <!-- Theme JS -->
        <script src="/client/assets/js/theme.min.js"></script>
    </body>

</html>
