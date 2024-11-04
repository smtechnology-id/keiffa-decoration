<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Admin - Keiffa Decoration</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logo.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/logo.png') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <a href="{{ route('admin.dashboard') }}" class="logo-icon"><span class="logo-text">Keiffa</span></a>
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="#">
                        <img src="{{ asset('assets/images/avatars/avatar.png') }}">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text">{{ Auth::user()->name }}<br><span
                                class="user-state-info">{{ Auth::user()->level }}</span></span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Apps
                    </li>
                    @if (Auth::user()->level == 'admin')
                        <li class="@yield('active-dashboard')">
                            <a href="{{ route('admin.dashboard') }}" class="active"><i
                                    class="material-icons-two-tone">dashboard</i>Dashboard</a>
                        </li>
                        <li class="@yield('active-order')">
                            <a href="{{ route('admin.order') }}" class="active"><i
                                    class="material-icons-two-tone">loyalty</i>Order</a>
                        </li>
                        <li class="@yield('active-portfolio')">
                            <a href="{{ route('admin.portfolio') }}" class="active"><i
                                    class="material-icons-two-tone">inventory</i>Portofolio</a>
                        </li>
                        <li class="@yield('active-package')">
                            <a href="{{ route('admin.package') }}" class="active"><i
                                    class="material-icons-two-tone">label</i>Katalog</a>
                        </li>
                        <li class="@yield('active-additional')">
                            <a href="{{ route('admin.additional') }}" class="active"><i
                                    class="material-icons-two-tone">add_shopping_cart</i>Additional</a>
                        </li>
                        <li class="@yield('active-review')">
                            <a href="{{ route('admin.review') }}" class="active"><i
                                    class="material-icons-two-tone">reviews</i>Review</a>
                        </li>
                        <li class="sidebar-title">
                            Account
                        </li>
                        <li class="@yield('active-user')">
                            <a href="" class="active"><i class="material-icons-two-tone">person</i>Data User</a>
                        </li>
                        <li class="@yield('active-logout')">
                            <a href="{{ route('logout') }}" class="active"><i
                                    class="material-icons-two-tone">logout</i>Logout</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="app-container">
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg" style="background-color: #7e4752; color: #fff;">
                    <div class="container-fluid">
                        <div class="navbar-nav" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link hide-sidebar-toggle-button" href="#"><i
                                            class="material-icons" style="color: #fff;">first_page</i></a>
                                </li>

                            </ul>

                        </div>
                        <div class="d-flex">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        class="d-flex align-items-center justify-content-center"><span
                                            class="material-icons" style="color: #fff;">
                                            logout
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-custom" role="alert">
                                <div class="custom-alert-icon icon-primary"><i
                                        class="material-icons-outlined">done</i>
                                </div>
                                <div class="alert-content">
                                    <span class="alert-title">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-custom" role="alert">
                                <div class="custom-alert-icon icon-warning"><i
                                        class="material-icons-outlined">error</i>
                                </div>
                                <div class="alert-content">
                                    <span class="alert-title">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-custom" role="alert">
                                <div class="custom-alert-icon icon-warning"><i
                                        class="material-icons-outlined">error</i>
                                </div>
                                <div class="alert-content">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('script')
    <!-- Javascripts -->
    <!-- Javascripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
</body>

</html>
