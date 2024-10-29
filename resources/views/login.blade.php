<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Keiffa Decoration Login Page">
    <meta name="keywords" content="login,decoration">
    <meta name="author" content="Keiffa Decoration">

    <title>Login - Keiffa Decoration</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="bg-light">
    <div class="app app-auth-sign-up d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-center mb-5" style="color: #7e4752;">
                                <img src="{{ asset('assets/logo.png') }}" alt="Keiffa Decoration Logo"
                                    class="img-fluid mb-4" style="max-width: 150px;">
                                <h2 class="text-primary" style="font-weight: 600; color: #7e4752;">Keiffa Decoration
                                </h2>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-custom" role="alert">
                                    <div class="custom-alert-icon icon-primary"><i
                                            class="material-icons-outlined">done</i></div>
                                    <div class="alert-content">
                                        <span class="alert-title">{{ session('success') }}</span>
                                    </div>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-custom" role="alert">
                                    <div class="custom-alert-icon icon-warning"><i
                                            class="material-icons-outlined">error</i></div>
                                    <div class="alert-content">
                                        <span class="alert-title">{{ session('error') }}</span>
                                    </div>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-custom" role="alert">
                                    <div class="custom-alert-icon icon-warning"><i
                                            class="material-icons-outlined">error</i></div>
                                    <div class="alert-content">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('loginPost') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"
                                        style="background-color: #7e4752; border-color: #7e4752;">Login</button>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
