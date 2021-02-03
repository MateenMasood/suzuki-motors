

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dore jQuery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/font/simple-line-icons/css/simple-line-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.rtl.only.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    {{-- ************** custom css file  ******************* --}}

    <link rel="stylesheet" href="{{ asset('assets/CustomCss/Auth/login.css') }}" />
</head>

<body class="background show-spinner no-footer">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class=" text-white h2">Employee Login</p>

                            <p class="white mb-0">
                                Please use your credentials to login.
                                <br>If you are not a member, please
                                <a href="#" class="white">register</a>.
                            </p>
                        </div>
                        <div class="form-side">
                            <div style="width:100%;text-align: center;"><a href="Dashboard.Default.html" style="margin: auto;">
                                <span class="logo-single" style="background: url(/assets/logo/suzuki_logo_2.png) no-repeat;background-size: contain;width: 93px;height: 60px;"></span>
                        </a></div>
                            <h6 class="mb-4">Login</h6>
                            <form id="loginForm" class="tooltip-right-bottom" method="POST" action="{{ route('login') }}" >
                            @csrf
                                <label class="form-group has-float-label mb-4">
                                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                    <span id="emailCheck">E-mail</span>
                                </label>


                                <label class="form-group has-float-label mb-4">
                                    <input id="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" placeholder="" />
                                    <span>Password</span>
                                </label>
                                @error('email')

                                <strong style="color :red;">{{ $message }}</strong>

                                @enderror


                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('password.request') }}">Forget password?</a>

                                    <button id="submit" class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dore.script.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>

    {{-- ********************* custom js files ******************* --}}

    <script src="{{ asset('assets/CustomJs/Auth/login.js') }}"></script>


</body>

</html>
