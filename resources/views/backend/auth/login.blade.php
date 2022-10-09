<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>
        
        <meta charset="utf-8" />
        <title>Sign In | WiqiCo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Yakesma" name="description" />
        <meta content="Yakesma" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/images/logo-yakesma/yakesma-laznas-sm.png') }}">

        <!-- Layout config Js -->
        <script src="{{ asset('login/js/layout.js') }}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('login/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('login/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('login/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{ asset('login/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .container{
                height: 100% !important;
            }
        </style>


    </head>

    <body>

        <div class="auth-page-wrapper">
            <!-- auth page bg -->
            <div class="bg-overlay"></div>
            <div class="auth-one-bg-position auth-one-bg"  id="auth-particles"></div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row d-flex justify-content-center align-content-center" style="height:100%;">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card" style="border-radius: 15px;">
                            
                                <div class="card-body p-4"> 
                                    <div class="text-center mt-2">
                                        <img src="{{ asset('img/sst.png') }}" alt="" height="250" class="mt-2">
                                        <h5 class="text-primary mt-4">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to web admin.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" required autofocus placeholder="Enter Username Or Email">
                                            </div>
                    
                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" required placeholder="Enter Password" name="password" id="password-input">
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                            </div>
                                            
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" type="submit">Sign In</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->
        </div>
        <!-- end auth-page-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="{{ asset('login/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('login/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('login/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('login/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('login/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('login/js/plugins.js') }}"></script>

        <!-- particles js -->
        <script src="{{ asset('login/libs/particles.js/particles.js') }}"></script>
        <!-- particles app js -->
        <script src="{{ asset('login/js/pages/particles.app.js') }}"></script>
        <!-- password-addon init -->
        <script src="{{ asset('login/js/pages/password-addon.init.js') }}"></script>
    </body>


</html>